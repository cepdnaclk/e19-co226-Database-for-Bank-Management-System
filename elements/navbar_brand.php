<?php

if (isset($navbar_brand ) && $navbar_brand == 'white'){
    echo '

    <img src="images/logo_new.png" class="img-fluid me-2 " width="30rem" alt="Logo" />
    <a class="navbar-brand" href="#" style="color: #fff;"><b>Treasure Island Bank</b></a>

    ' ;
}else{

    echo '

    <img src="images/logo_new.png" class="img-fluid me-2 " width="30rem" alt="Logo" />
    <a class="navbar-brand" href="#" style="color: #000;"><b>Treasure Island Bank</b></a>
    
    ' ;

}
