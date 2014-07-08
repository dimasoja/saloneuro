<div id="inside_container">
<h1 style="padding-left:30px;">Take a look at videos of us working</h1>
<p class="fontsize18" style="padding-left:30px;"><strong>Simply click on any of the thumbnails to view video in main player</strong></p>
<?php if (count($videos) > 0): ?>
<div id="player-block">
    <div id='player'>Loadnig...</div>
</div>
<div>
    <table width="708" align="center" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td valign="top" width="1" class="arrow">
                    <div class="left_arrow">
                        <a onmouseup="dw_scrollObj.resetSpeed('wn')" onmousedown="dw_scrollObj.doubleSpeed('wn')" onmouseover="dw_scrollObj.initScroll('wn','left')" onclick="return false" onmouseout="dw_scrollObj.stopScroll('wn')" href="javascript:void(0);">
                            <img src="<?php echo URL::base(); ?>images/left-arrow.gif" border="0" />
                        </a>
                    </div>
                </td>
                <td>
                    <div id="hold">
                        <div id="wn">
                            <div style="top: 0pt; left: 0pt; visibility: visible;" class="content" id="lyr1">
                                <table id="t1" border="0" cellpadding="0" cellspacing="6">
                                    <tbody>
                                        <tr id="thumbs" >
                                            <?php foreach ($videos as $video): ?>
                                            <td>
                                                <a href="javascript:void(0);" onclick="showVideo('<?php echo $video->filename; ?>');">
                                                    <img class="video_td" rel="<?php echo $video->filename; ?>" src="<?php echo URL::base(); ?>uploads/images/<?php echo $video->thumbnail; ?>" style="max-height: 185px; border: 3px solid #000;"/>
                                                </a>
                                            </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </td>
                <td valign="top" width="1" class="arrow">
                    <div class="right_arrow">
                        <a onmouseup="dw_scrollObj.resetSpeed('wn')" onmousedown="dw_scrollObj.doubleSpeed('wn')" onmouseover="dw_scrollObj.initScroll('wn','right')" onclick="return false" onmouseout="dw_scrollObj.stopScroll('wn')" href="javascript:void(0);">
                            <img src="<?php echo URL::base(); ?>images/right-arrow.gif" border="0" />
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="clear"></div>
</div>
<?php endif; ?>
</div>
<script type="text/javascript" src="<?php echo URL::base(); ?>jwplayer/jwplayer.js"></script>
<script type="text/javascript">
    jwplayer('player').setup({
        'flashplayer': '<?php echo URL::base(); ?>jwplayer/player.swf',
        'width': '600',
        'height': '400',
        'controlbar': 'bottom'
    });
    
    function showVideo(src) {
        jQuery('.video_td').each(function(){
            jQuery(this).css({border: '3px solid #000'});
            if (jQuery(this).attr('rel') == src) {
                jQuery(this).css({border: '3px solid orange'});
            }
        });
        jwplayer('player').load([
            {file: '<?php echo URL::base(); ?>uploads/videos/' + src}
        ]);
        jwplayer('player').play();
    }
</script>