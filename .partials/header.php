<?php require_once('ipcek.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="keywords" content="Ahadizapto, 9hs, Check Tor Network, Cek IP Publik">
  <meta name="description" content="Provide IT Solution for You, We Make IT Happen">
  <meta name="author" content="Sapto Hadi" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="240; url=index.php">
  <title>Ahadizapto [<?= $visitors ?>] </title>
  <link rel="icon" type="image/png" sizes="16x16" href="/localtime/_/images/ico2.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="/localtime/_/scripts/jam.js"></script>
  <style>
    .logo,
    .search,
    .iframe,
    .centerdonasi, 
    .centermsg,
    .center, 
    .cf{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .headbtn {
        margin-top: 15vh;
    }
    
    .centermsg {
        margin-top: 1.5vh;
    }

    .logo,
    .search{
        margin-bottom: 2vh;
    }
    
    .search {
        margin-top: 5vh;
    }
    
    body.bg {
        background: url(/localtime/_/images/bg-02.png) repeat;
    }
    
    div.bg {
        background: bg-white;
    }
    
    .fsb-7 {
        font-size: 0.7em;
    }
    
    .fsb-8 {
        font-size: 0.8em;
    }
    
    .con {
        margin-top: -5vh;
    }
    
    .donasi {
        position: fixed;
        top: 2em;
    }
    
    .klikdonasi {
        font-size: 0.4em;
    }
  </style>
</head>
<body onload="timer_function();" class="bg"><div class="bg">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img class="img-fluid" style="width: 30px; height: auto;" src="/localtime/_/images/ico2.png">    
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                StorageMod
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item small" href="https://drive.9hs.my.id" target="_blank">Native</a></li>
                <li><hr class="dropdown-divider small"></li>
                <li><a class="dropdown-item small" href="https://cloud.9hs.my.id" target="_blank">Nextcloud</a></li>
                <!--<li><hr class="dropdown-divider small"></li>-->
                <!--<li><a class="dropdown-item small" href="https://aio.9hs.my.id" target="_blank">Nextcloud AIO</a></li>-->
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                CommunityAlt
              </a>
              <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item small" href="https://lemmy.9hs.my.id" target="_blank">
                        <abbr title="Reddit Alternative">Lemmy</abbr> ID
                    </a>
                </li>
                <li><hr class="dropdown-divider small"></li>
                <li><a class="dropdown-item small" href="https://wefwef.9hs.my.id" target="_blank">Voyager App</a></li>
              </ul>
            </li>
            <!--<li class="nav-item">-->
            <!--  <a class="nav-link" aria-current="page" href="https://stats.uptimerobot.com/423wOfz9O4" target="_blank">UptimeRobot</a>-->
            <!--</li>-->
          <!--  <li class="nav-item">-->
          <!--    <a class="nav-link" href="#">Link</a>-->
          <!--  </li>-->
            <!--<li class="nav-item dropdown">-->
            <!--  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
            <!--    Cronitor-->
            <!--  </a>-->
            <!--  <ul class="dropdown-menu">-->
            <!--    <li><a class="dropdown-item small" href="https://ditjenpptr.cronitorstatus.com/" target="_blank">Ditjen PPTR ATR/BPN</a></li>-->
            <!--    <li><hr class="dropdown-divider small"></li>-->
            <!--    <li><a class="dropdown-item small" href="https://sirus.cronitorstatus.com/" target="_blank">Rumah Swadaya PUPR</a></li>-->
            <!--  </ul>-->
            <!--</li>-->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Live Status
              </a>
              <ul class="dropdown-menu">
                <li><img height="30px" height="80px" class="dropdown-item small" src="https://cronitor.io/badges/bdgGjE/production/NcH7OP_Dyo70Y3meJ6YEEqEKgaU.svg"></li>
                <li><hr class="dropdown-divider small"></li>
                <li><img height="30px" height="80px" class="dropdown-item small" src="https://cronitor.io/badges/ErA00u/production/TElGxScO5zozyxSf4_er-y5YAYA.svg"></li>
                <li><hr class="dropdown-divider small"></li>
                <li><img height="30px" height="80px" class="dropdown-item small" src="https://cronitor.io/badges/Os2IhJ/production/tpS6w5qjIeOW4rJoMGOTR3FWXWs.svg"></li>
                <li><hr class="dropdown-divider small"></li>
                <li><img height="30px" height="80px" class="dropdown-item small" src="https://cronitor.io/badges/OyppaC/production/7lAyZGh34pyp3rLS-4F3EZa5xVI.svg"></li>
                <li><hr class="dropdown-divider small"></li>
                <li><img height="30px" height="80px" class="dropdown-item small" src="https://cronitor.io/badges/w8WGFH/production/E8MQZIHz7m_5E3NcHbTmI80A3Jw.svg"></li>
                <li><hr class="dropdown-divider small"></li>
                <li><img height="30px" height="80px" class="dropdown-item small" src="https://cronitor.io/badges/pbspyU/production/8Jlpt9O5jBoiKUSvIS535fcLyJY.svg"></li>
              </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link text-grey small" href="https://webchat.oftc.net/?nick=&channels=%23ahadizapto&uio=d4" target="_blank">
                 <abbr title="Web IRC">webChat</abbr>
                </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>