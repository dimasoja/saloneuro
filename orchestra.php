	
<link media="all" rel="stylesheet" href="/css/inside/events.orchestra.css">

<div class="game game-orchestra" data-game="orchestra" style="display: none;" data-action="/games/check">
    <div class="game-start" data-step="start" style="display: none;">
        <h2>&laquo;НЕУЛОВИМЫЙ ОРКЕСТР&raquo;</h2>
        <img src="/images/events/orchestra/description.png" alt="">
        <a href="#!/games/orchestra/play" class="button">Старт</a>
    </div>
    <div class="game-loader" data-step="loader" style="display: none;">
        <h3>
            <span>Настройся на победу</span>
            <span style="display: none;">Сосредоточь внимание</span>
            <span style="display: none;">Держи мышку крепче</span>
        </h3>
        <h2>0%</h2>
    </div>
    <div class="game-act" data-step="act" style="display: none;">
        <div class="game-nav">
            <ul>
                <li class="game-nav-rules"><a href="#!/games/orchestra">правила игры</a></li>
                <li class="game-nav-restart"><a href="#">играть сначала</a></li>
                <li class="game-nav-pause"><a href="#">пауза</a></li>
                <li class="game-nav-stop"><a href="#">стоп</a></li>
                <li class="game-nav-time">время <span>0:00</span></li>
                <li class="game-nav-point">баллы <span>0</span></li>
                <li class="game-nav-level">уровень <span>1</span></li>
            </ul>
        </div>
        <div class="game-back">

        </div>
        <div class="game-area">

        </div>
    </div>
    <div class="game-final" data-step="final" style="display: none;">
        <h2>игра окончена</h2>
        <div class="final-block">
            <a href="#!/rating" class="button button-rating">Рейтинг</a>
            <div class="final-points">Ты получил <strong>0</strong> баллов!</div>
            <a href="#!/games/orchestra/play" class="button button-again">Играть еще</a>
            <div class="clear"></div>
        </div>
        <h3>победители будут объявлены</h3>
        <img src="/images/events/orchestra/calendar.png" alt="">
    </div>
</div>

<script src="/js/orchestra.js"></script>