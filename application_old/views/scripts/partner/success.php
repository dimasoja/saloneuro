<div class="success-mess"><h3>Спасибо! Мы постараемся ответить вам в ближайшее время. Через 5 секунд вы будете перенаправлены на главную страницу сайта</h3></div>
<script language="JavaScript">
t=1; 
function dorefresh() 
  { 
    ti=setTimeout("dorefresh();",4000); 
    if (t>0) 
      { 
        t-=1; 
      } else 
      { 
        clearTimeout(ti); 
        window.location="/"; 
      }
  } 
window.onLoad=dorefresh();
</script>