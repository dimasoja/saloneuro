<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_ConfirmedBooking extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    private $_quotation_pages;
    private $_maintenance_pages;
    private $_count_per_page = 30;
    private $_column_arr = array(
            'name' => "Name", 
            'address' => "Address", 
            'phone' => "Telephone number",
            'mphone' => "Mobile number",
            'work_date' => "Booking Date",
            'payment' => "Deposit Paid",
            'balance' => "Balance Pending",
            'total_price_for_job' => "Total Value",
            'work_complete' => "Work Status"
        );
    
    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "services";
        
        $count_users = count(ORM::factory('quotation')->where('payment_status', '=', 1)->find_all()->as_array());
        $this->_quotation_pages = ceil($count_users / $this->_count_per_page);
        $count_users = count(ORM::factory('maintenancecontract')->where('payment_status', '=', 1)->find_all()->as_array());
        $this->_maintenance_pages = ceil($count_users / $this->_count_per_page);
    }

    public function action_index()
    {
        $view = new View('scripts/admin/confirmedbooking/index');
        $this->page_title = __("Confirmed Booking");
        $view->columns = $this->_column_arr;
        $this->display($view);
    }
    
    public function action_excelexport() 
    {
        $this->auto_render = false;
        if (!empty($_POST['columns'])) {
            
            $quotations = ORM::factory('quotation')->where('payment_status', '=', 1)->find_all()->as_array();
            $values = array();
            foreach ($_POST['columns'] as $key => $column) {
                $values[0][$key] = $this->_column_arr[$column];
            }
            
            $key = 1;
            foreach ($quotations as $quotation) {
                for($i = 0; $i < count($_POST['columns']); $i++) {
                    if ($_POST['columns'][$i] == "work_date") {
                        $values[$key][$i] = date("d/m/Y", $quotation->$_POST['columns'][$i]);
                    } elseif ($_POST['columns'][$i] == "balance") {
                        $values[$key][$i] = $quotation->total_price_for_job - $quotation->payment;
                    } elseif ($_POST['columns'][$i] == "work_complete") {
                        if ($quotation->work_complete == 1) {
                            $values[$key][$i] = "Complete";
                        } else {
                            $values[$key][$i] = "Not complete";
                        }
                    } elseif ($_POST['columns'][$i] == "address") {
                        $values[$key][$i] = $quotation->address . "\n" . $quotation->town . "\n" . $quotation->postcode;
                    } else {
                        $values[$key][$i] = $quotation->$_POST['columns'][$i];
                    }
                }
                $key++;
            }
            
            $xls = new XLSExporter('FloorSandUK_export_confirmed_booking' . date("d_m_Y_h_i_s"));
            $xls->build($values);
        } else {
            Request::instance()->redirect( Route::get('admin')->uri() );
        }
    }
    
    public function action_savestatus()
    {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $quotation = ORM::factory('quotation')->where('id_quotation', '=', $_POST['id_quotation'])->find();
            $quotation->work_complete = $_POST['status'];
            $quotation->save();
        }
    }
    
    public function action_changeconfirmed()
    {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $page = $_POST['p'] || 1;
            switch ($_POST['d']) {
                case 0:
                    $quotations = ORM::factory('quotation')->where('payment_status', '=', 1)
                                                           ->limit($this->_count_per_page)
                                                           ->offset($this->_count_per_page * ($page - 1))
                                                           ->order_by('id_quotation', 'desc')
                                                           ->find_all()
                                                           ->as_array();
                    $html = "<input type=\"button\" value=\"CONFIRMED MAINTENANCE CONTRACTS\" class=\"submit\" onclick=\"changeConfirmed(1,1);\" />\n";
                    if (!empty($quotations)) {
                        $html .= "<table class=\"quotation-user\" cellpadding=\"0\" cellspacing=\"0\">\n";
                        $html .= "<tr>\n";
                        $html .= "<th>Name</th>\n";
                        $html .= "<th>Address</th>\n";
                        $html .= "<th>Tel. No.</th>\n";
                        $html .= "<th>Mob. No.</th>\n";
                        $html .= "<th>Date of booking</th>\n";
                        $html .= "<th>Deposit paid &pound;</th>\n";
                        $html .= "<th>Balance pending &pound;</th>\n";
                        $html .= "<th>Total Value &pound;</th>\n";
                        $html .= "<th>Work Status</th>\n";
                        $html .= "</tr>\n";
                        $total = 0;
                        foreach ($quotations as $quotation) {
                            $html .= "<tr>\n";
                            $html .= "<td>" . $quotation->name . "</td>\n";
                            $html .= "<td>";
                            $html .= $quotation->address . "<br />" . $quotation->town . "<br />" . $quotation->postcode;
                            $html .= "</td>\n";
                            $html .= "<td>" . $quotation->phone . "</td>\n";
                            $html .= "<td>" . $quotation->mphone . "</td>\n";
                            $html .= "<td>" . date("d/m/Y", $quotation->work_date) . "</td>\n";
                            $html .= "<td>" . $quotation->payment . "</td>\n";
                            $html .= "<td>" . ($quotation->total_price_for_job - $quotation->payment) . "</td>\n";
                            $html .= "<td>" . $quotation->total_price_for_job . "</td>\n";
                            if ($quotation->work_complete == 0) {
                                $total += $quotation->total_price_for_job;
                            }
                            $html .= "<td align=\"center\">";
                            $html .= "<input rel=\"" . $quotation->total_price_for_job . "\" type=\"checkbox\" onclick=\"changeWorkStatus(this, " . $quotation->id_quotation . ");\"";
                            if ($quotation->work_complete == 1) {
                                $html .= " checked=\"checked\"";
                            }
                            $html .= " /></td>\n";
                            $html .= "</tr>\n";
                        }
                        $html .= "<tr>\n";
                        $html .= "<td colspan=\"7\"></td>\n";
                        $html .= "<td colspan=\"2\" style=\"font-size: 18px; color: #F65D20;font-weight: bold;\">";
                        $html .= "Total &pound;: <span id=\"total\" style=\"color: #fff\">" . $total . "</span></td>\n";
                        $html .= "</tr>\n";
                        $html .= "</table>\n";
                        $html .= "<div class=\"clear\"></div>\n";
                        if ($this->_quotation_pages > 1) {
                            $html .= "<div id=\"sws_pages\">\n";
                            $str_pages = "";
                            for ($pg = 1; $pg <= $pages; $pg++) {
                                if ($page == $pg) {
                                    $str_pages .= $pg . " | ";
                                } else {
                                    $str_pages .= '<a href="javascript:void(0);" onclick="changeConfirmed(0,' . $pg . ')">' . $pg . '</a> | ';
                                }
                            }
                            $str_pages = substr($str_pages, 0, -3);
                            $html .= $str_pages;
                            $html .= "</div>\n";
                        }
                    }
                    break;
                case 1:
                    $maintenances = ORM::factory('maintenancecontract')->where('payment_status', '=', 1)
                                                           ->limit($this->_count_per_page)
                                                           ->offset($this->_count_per_page * ($page - 1))
                                                           ->order_by('id_maintenance', 'desc')
                                                           ->find_all()
                                                           ->as_array();
                    $html = "<input type=\"button\" value=\"CONFIRMED ONLINE QUOTATION\" class=\"submit\" onclick=\"changeConfirmed(0,1);\" />\n";
                    if (!empty($maintenances)) {
                        $html .= "<table class=\"quotation-user\" cellpadding=\"0\" cellspacing=\"0\">\n";
                        $html .= "<tr>\n";
                        $html .= "<th>Name</th>\n";
                        $html .= "<th>Address</th>\n";
                        $html .= "<th>Tel. No.</th>\n";
                        $html .= "<th>Mob. No.</th>\n";
                        $html .= "<th>Option type</th>\n";
                        $html .= "<th>Total Value &pound;</th>\n";
                        $html .= "<th>Deposited, &pound;</th>\n";
                        $html .= "<th>Balance pending, &pound;</th>\n";
                        $html .= "<th></th>\n";
                        $html .= "<th>Work Status</th>\n";
                        $html .= "</tr>\n";
                        $total = 0;
                        foreach ($maintenances as $maintenance) {
                            $html .= "<tr>\n";
                            $html .= "<td>" . $maintenance->name . "</td>\n";
                            $html .= "<td>";
                            $html .= $maintenance->address . "<br />" . $maintenance->town . "<br />" . $maintenance->postcode;
                            $html .= "</td>\n";
                            $html .= "<td>" . $maintenance->phone . "</td>\n";
                            $html .= "<td>" . $maintenance->mphone . "</td>\n";
                            $html .= "<td>" . $maintenance->option_type . "</td>\n";
                            $html .= "<td>" . $maintenance->total_price_for_job . "</td>\n";
                            $html .= "<td>" . $maintenance->option_price . "</td>\n";
                            if ($maintenance->work_complete == 0) {
                                $total += $maintenance->option_price;
                            }
                            $html .= "<td>";
                            if ($maintenance->option_type == "option 1") {
                                $html .= "0.00";
                            }
                            $html .= "</td>\n";
                            $html .= "<td><a href=\"" . URL::base() . "admin/maintenance/details/" . $maintenance->id_maintenance . "\">Details</a></td>\n";
                            $html .= "<td align=\"center\">";
                            $html .= "<input rel=\"" . $maintenance->total_price_for_job . "\" type=\"checkbox\" onclick=\"changeWorkStatus2(this, " . $maintenance->id_maintenance . ");\"";
                            if ($maintenance->work_complete == 1) {
                                $html .= " checked=\"checked\"";
                            }
                            $html .= " /></td>\n";
                            $html .= "</tr>\n";
                        }
                        $html .= "<tr>\n";
                        $html .= "<td colspan=\"8\"></td>\n";
                        $html .= "<td colspan=\"2\" style=\"font-size: 18px; color: #F65D20;font-weight: bold;\">";
                        $html .= "Total &pound;: <span id=\"total\" style=\"color: #fff\">" . $total . "</span></td>\n";
                        $html .= "</tr>\n";
                        $html .= "</table>\n";
                        $html .= "<div class=\"clear\"></div>\n";
                        if ($this->_maintenance_pages > 1) {
                            $html .= "<div id=\"sws_pages\">\n";
                            $str_pages = "";
                            for ($pg = 1; $pg <= $pages; $pg++) {
                                if ($page == $pg) {
                                    $str_pages .= $pg . " | ";
                                } else {
                                    $str_pages .= '<a href="javascript:void(0);" onclick="changeConfirmed(1,' . $pg . ')">' . $pg . '</a> | ';
                                }
                            }
                            $str_pages = substr($str_pages, 0, -3);
                            $html .= $str_pages;
                            $html .= "</div>\n";
                        }
                    }
                    break;
                default: 
                    break;
            }
            echo $html;
        }
    }

}