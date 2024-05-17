    <?php 
        include '.partials/header.php'
    ?>
    
    <div class="d-flex justify-content-center align-items-center bg-gray-100 dark:bg-gray-900 headbtn">
        <div class="row">
            &nbsp;
        </div>
    </div>
    
    <div class="logo">
        <img src="/localtime/_/images/alhadizapto.png" alt="logo" width="300vw">
    </div>
    
    <div class="search row">
        <div class="col-8 col-xs-4 col-md-8 col-lg-6 col-xl-6">
            <form role="search" method="get" id="ddgSearch" action="https://duckduckgo.com/" target="_blank">
                <div class="input-group mb-3">
                    <input type="hidden" name="sites" value=""/>
                    <input type="hidden" name="k7" value="#ffffff"/>
                    <input type="hidden" name="k8" value="#222222"/>
                    <input type="hidden" name="k9" value="#00278e"/>
                    <input type="hidden" name="kx" value="#20692b"/>
                    <input type="hidden" name="kj" value="#fafafa"/>
                    <input type="hidden" name="kt" value="p"/>
                    <button class="btn btn-outline-success rounded-start border-end-0" type="submit" id="ahz-duckgo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search-heart" viewBox="0 0 16 16">
                          <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018Z"/>
                          <path d="M13 6.5a6.471 6.471 0 0 1-1.258 3.844c.04.03.078.062.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1.007 1.007 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5ZM6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11Z"/>
                        </svg>
                    </button>
                    <input type="search" class="form-control border border-success border-end-0 border-start-0 text-center" name="q" placeholder="Search on DuckDuckGo" aria-label="Search" aria-describedby="ahz-duckgo"/>
                    <button class="btn btn-outline-success border-start-0" type="submit" id="ahz-duckgo">
                        <img class="img-fluid" style="width: 21px; height: auto;" src="/localtime/_/images/duckduckgo.svg">
                    </button>
                </div>
            </form>
        </div>
        <ul id="searchResults"></ul>
    </div>
    
    <div>
        <div class="centerdonasi">
            <?php
                // $ipdata = $cek2->ip;
                $searchfor = getUserIP();
                
                // the following line prevents the browser from parsing this as HTML.
                // header('Content-Type: text/plain');
                
                // get the file contents, assuming the file to be readable (and exist)
                $contents = file_get_contents($filetorbulkexitlist);
                
                // escape special characters in the query
                $pattern = preg_quote($searchfor, '/');
                
                // finalise the regular expression, matching the whole line
                $pattern = "/^.*$pattern.*\$/m";
                
                // search, and store all matching occurences in $matches
                if (preg_match_all($pattern, $contents, $matches))
                {
                   echo "
                    <label class='donasi rounded text-white text-uppercase px-2 py-1 m-1 text-center' style='background-color: #6f42c1;'>
                        <a href='https://donate.torproject.org/' class='text-decoration-none text-white' target='_blank'>
                            <img src='https://www.torproject.org/static/images/tor-logo@2x.png?h=16ad42bc' width='40em'>
                            <br> <span class='klikdonasi'>info donasi</span>
                        </a>
                    </label>
                   ";
                }
            ?>
        </div>
        
        <div class="centermsg">
            <label class="text-primary py-1 px-2 bg-white" id="msg"></label>
        </div>
        
        <div class="iframe">
            <?php
                if ($_SERVER['SERVER_PORT'] == 443) {
                  echo "<iframe src='/localtime/_/sec.html' width='80%'></iframe> \n";
                }
                
                if ($_SERVER['SERVER_PORT'] == 80) {
                  echo "<iframe src='/localtime/_/wow.html' width='80%'></iframe> \n";
                }
            ?>
        </div>
    </div>
    <div class="bg">
        <?php 
            if ($mobile == "null" || ($cek->security->vpn||$cek->security->tor||$cek->security->proxy||$cek->security->relay) == true){ ?>
                <div class="center fsb-7 con">
                    <?php
                        if ($mobile == "null"){
                            echo '';
                        } else {
                            echo '<label class="bg-warning rounded text-white text-uppercase px-2 m-1">mobile</label>';
                        }
                        
                        if (($cek->security->vpn) == false){
                            echo '';
                        } else {
                            echo '<label class="bg-danger rounded text-white text-uppercase px-2 m-1">vpn</label>';
                        }
                        
                        if (($cek->security->proxy) == false){
                            echo '';
                        } else {
                            echo '<label class="bg-info rounded text-white text-uppercase px-2 m-1">proxy</label>';
                        }
                        
                        if (preg_match_all($pattern, $contents, $matches)){
                           echo "<label class='rounded text-white text-uppercase px-2 m-1' style='background-color: #6f42c1;'>tor</label>";
                        }
                        
                        if (($cek->security->relay) == false){
                            echo '';
                        } else {
                            echo '<label class="bg-primary rounded text-white text-uppercase px-2 m-1">relay</label>';
                        }
                    ?>
                </div>
            
                <div class="center fsb-8">
                    <strong><?= $cek->ip ?></strong>
                </div>
                
                <div class="center fsb-8">
                    <?= "<a class='text-decoration-none' target='_blank' href='https://ipinfo.io/" . $cek->network->autonomous_system_number . "'>" . $cek->network->autonomous_system_number . "</a> | " . $cek->network->autonomous_system_organization ?>
                </div>
            
                <div class="center fsb-8 mb-5">
                <?php
                    $country_id= $cek->location->country_code;
                    $city = $cek->location->city;
                    $region = $cek->location->region;
                    if (($city && $region) == "") {
                        $cityRegion = "";
                    } elseif ($city == $region) {
                        $cityRegion = $city . " | ";
                    } else {
                        $cityRegion = $cek->location->city . " | " . $cek->location->region . " | ";
                    }
                ?>
                <?= $cityRegion . $cek->location->country . ", " . $country_id . "&nbsp; <img src='https://ipdata.co/flags/" . strtolower($country_id) . ".png' width='20px' height='13px'>" ?>
            </div>
        <?php } ?>
  
        <div class="cf-turnstile cf" data-sitekey="0x4AAAAAAABJonkRgaRmyxXF" data-callback="javascriptCallback"></div>
    </div>
    
    <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/60e8d4b9d6e7610a49aa8988/1fa6ntu8f';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
    <!--End of Tawk.to Script-->

    <?php include '.partials/footer.php'; ?>