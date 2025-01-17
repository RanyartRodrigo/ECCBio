.fc-event, .fc-event-dot, .ui-widget-header, .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
    border: 1px solid #3e0000 !important;
    background: #3e0000 !important;
    font-weight: normal;
    color: #5f5f5f;
}
.Mprincipal .active {
    background: #3e0000 !important;
    color: #fcfcfc !important;
}
.Msecundario .active {
    background: #5f5f5f !important;
    color: #fcfcfc !important;
}
.slider {
    height: 10px !important;
    background: #cecece !important;
    width: 120px !important;
    border: #fcfcfc 2px solid !important;
    left: 130px;
    top: -20px;
}
#banner p {
    float: left;
    margin: 0px;
    margin-left: 20px;
    line-height: 30px;
    font-size: 15px;
    font-weight: bolder;
    cursor: pointer;
}
#banner .logos {
    float: left;
    margin-top: 8px;
    margin-left: 10px;
    height: 18px;
    cursor: pointer;
}
.capa>div{
    width: 100%;
    height: 35px
}
.capa i{
        float: left;
    padding: 7px !important;
    margin: 0px !important;
}
.capa .title{
    float: left;
    padding: 0px !important;
    margin: 0px !important;
}
#capas>*, #infoMap>*  {
    border-bottom: solid 3px;
    margin: 15px;
    padding-bottom: 7px;
}
#primero {
    color: #a52020;
}
#segundo {
    color: #20a520;
}
#tercero {
    color: #233220;
}
#cuarto {
    color: #aaa567;
}
#sexto {
    color: #accaa0;
}
#septimo {
    color: #20777c;
}
#octavo {
    color: #c58880;
}
#noveno {
    color: #cabd50;
}
#capas, #infoMap{
   border:solid 2px ; 
}
.capa input[type="button"] {
    float: right;
    border-radius: 30px;
    background: #fcfcfc;
    border: solid 2px red;
    color: red;
    width: 20px;
    height: 20px;
    line-height: 15px;
    padding: 0px;
}
 @media(min-width:768px){
    #banner {
    position: fixed;
    width: 100%;
    bottom: 0px;
    height: 40px;
    background: rgba(240,240,240,0.5);
    padding: 5px;
}
#capas {
    box-shadow: -6px 7px 13px 7px rgba(0, 0, 0, 0.28);
    width: 300px;
    position: fixed;
    background: rgba(240,240,240,0.5);
    bottom: 49px;
    left: 35px;
    max-height: 35%;
    overflow-y: auto;
    border: 0px !important;
}
#infoMap {
    box-shadow: -4px 6px 8px 0px rgba(152, 19, 19, 0.12);
    width: 300px;
    position: fixed;
    background: rgba(240,240,240,0.5);
    bottom: 50px;
    right: 50px;
    max-height: 35%;
    overflow-y: auto;
    border: 0px !important;
}
div#map {
    position: fixed !important;
    width: 100%;
    height: 100%;
    top: 0%;
    left: -20px;
}
.navbar {
    z-index: 2;
    position: fixed !important;
    width: 100%;
}
.navbar-side{
    top: 60px;
        height: auto;
}
}
div#map {
    width: 100%;
    min-height: 600px;
}


















/* SLIDE THREE */
.slideThree {
    width: 80px !important;
    height: 26px !important;
    background: #cecece !important;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    position: relative;

    -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
}

.slideThree:after {
    content: 'OFF';
    font: 12px/26px Arial, sans-serif;
    color: #000;
    position: absolute;
    right: 10px;
    z-index: 0;
    font-weight: bold;
    text-shadow: 1px 1px 0px rgba(255,255,255,.15);
}

.slideThree:before {
    content: 'ON';
    font: 12px/26px Arial, sans-serif;
    color: #00bf00;
    position: absolute;
    left: 10px;
    z-index: 0;
    font-weight: bold;
}

.slideThree label {
    display: block;
    width: 34px;
    height: 20px;

    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;

    -webkit-transition: all .4s ease;
    -moz-transition: all .4s ease;
    -o-transition: all .4s ease;
    -ms-transition: all .4s ease;
    transition: all .4s ease;
    cursor: pointer;
    position: absolute;
    top: 3px;
    left: 3px;
    z-index: 1;

    -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    background: #fcfff4;

    background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
}

.slideThree input[type=checkbox]:checked + label {
    left: 43px;
}
h1 {
    color: #eee;
    font: 30px Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    text-shadow: 0px 1px black;
    text-align: center;
    margin-bottom: 50px;
}

input[type=checkbox] {
    visibility: hidden;
}



/* SLIDE THREE */
.miniSlideThree {
        float: right;
    margin-top: 10px;
    margin-left: 9px;
    width: 30px !important;
    height: 13px !important;
    background: #cecece !important;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    position: relative;
    -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
}

.miniSlideThree:after {
    content: 'N';
    font: 10px/15px Arial, sans-serif;
    color: #f00;
    position: absolute;
    right: 2px;
    z-index: 0;
    font-weight: bold;
    text-shadow: 1px 1px 0px rgba(255,255,255,.15);
}

.miniSlideThree:before {
    content: 'Y';
    font: 10px/15px Arial, sans-serif;
    color: #00bf00;
    position: absolute;
    left: 2px;
    z-index: 0;
    font-weight: bold;
}
.miniSlideThree label {
    display: block;
    width: 15px;
    height: 10px;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    -webkit-transition: all .4s ease;
    -moz-transition: all .4s ease;
    -o-transition: all .4s ease;
    -ms-transition: all .4s ease;
    transition: all .4s ease;
    cursor: pointer;
    position: absolute;
    top: 1px;
    left: 1px;
    z-index: 1;
    -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    background: #ff0000;
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
}

.miniSlideThree input[type=checkbox]:checked + label {
    left: 15px;
    background: #43c743;
}
h1 {
    color: #eee;
    font: 30px Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    text-shadow: 0px 1px black;
    text-align: center;
    margin-bottom: 50px;
}


.icon {
    color: #fcfcfc !important;
    padding: 20px;
    width: 140px;
    border-radius: 80px;
    height: 140px;
    margin:auto;
}
.icon i {
    width: 100px;
    height: 100px;
    font-size: 57px;
    float: left;
    background: #3e0000;
    border-radius: 200px;
    padding: 19px;
    padding-top: 22px;
}
.cursoInfo {
    width: 640px;
    margin: auto;
}
#map {
    width: 600px;
    height: 400px;
    margin: 20px;
}
a{
    cursor:pointer !important;
}
.wow > img, .box-container > img {
    width: 230px;
    height: 230px;
    border-radius: 115px;
    margin-top: 10px;
}
.slider-2-text >img {
    width: 150px;
    height: 150px;
}
iframe {
    background-image: url(../img/loading.gif);
    background-size: 100% 100%;
}
.friends {
    margin-top: 40px;
    padding: 15px 15px 20px 15px;
    background: rgba(240,240,240,0.5);
    border-bottom: 2px solid #3e0000;
}
.friends > img {
    width: auto;
    height: 100px !important;
    border-radius: 0px !important;
}
.icono {
    width: 80px;
    height: 90px;
    padding-top: 25px;
    padding-bottom: 25px;
    background: rgba(240,240,240,0.5);
    float: left;
    padding-left: 5px;
    padding-right: 5px;
}

body {
    background: #fcfcfc;
    text-align: center;
    font-family: 'Open Sans', sans-serif;
    color: #5f5f5f;
    font-size: 12px;

}

.violet { color: #3e0000; }

a {
    color: #3e0000;
    text-decoration: none;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}
a:hover, a:focus { color: #5f5f5f; text-decoration: none; }

strong { font-weight: bold; }

img { max-width: 100%; }

h1, h2 { line-height: 40px; }
h3, h4 { line-height: 20px; }

::-moz-selection { background: #3e0000; color: #fcfcfc; text-shadow: none; }
::selection { background: #3e0000; color: #fcfcfc; text-shadow: none; }


/***** Big links / buttons *****/
.right {
    float: right;
    width: 50%;
    border-left: solid 3px;
    margin-right:1.5px;

}
.right>i{
        border-radius: 20px;
    border-bottom-left-radius: 0px;
        transform: rotate(5deg);
}
.left>i{
        border-radius: 20px;
    border-bottom-right-radius: 0px;
        transform: rotate(-5deg);
}
.linetime{
    overflow:auto !important;
}
.linetime i {
    background: #3e0000;
    font-size: 20px;
    color: #fcfcfc;
    padding: 10px;
    width: 40px;
    height: 40px;
}
.linetime i:hover {
    border: solid 2px;
    cursor: pointer;
    color: #5f5f5f;
}
.right >*{
    float:left;
}
.left > *{
    float:right;
}
.linetime p {
    background: rgba(240,240,240,0.5);
    padding: 11px;
    border-radius: 100px;
    color: #5f5f5f;
}
.left {
    float: left;
    width: 50%;
    border-right: solid 3px;
    margin-left:1.5px;
}
.amigos img {
    float: left;
    width: 100px;
    height: 100px;
    border: solid 2px;
}
.amigos .informacion {
    float: left;
    width: 200px;
    padding: 5px;
    overflow: hidden;
}

.amigos > div {
    width: 100%;
    float: left;
    padding: 10px;
    border-bottom: solid 1px;
    margin-bottom: 10px;
}
a.big-link-1 {
  display: inline-block;
    padding: 5px 22px;
    background: #3e0000 !important;
    color: #fcfcfc !important;
    font-style: italic;
    text-decoration: none;
    -moz-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
        border-radius: 200px;
}

a.big-link-1:hover {
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
    color:#3e0000 !important;
    background:#fcfcfc !important;
    cursor:pointer;
    border:solid 1px;
}

a.big-link-1:active {
    -moz-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
}

a.big-link-2 {
    display: inline-block;
    width: 35px;
    height: 35px;
    padding-top: 6px;
    background: #3e0000;
    font-size: 20px;
    color: #fcfcfc;
    line-height: 20px;
    -moz-border-radius: 19px; -webkit-border-radius: 19px; border-radius: 19px;
    -moz-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
}
a.big-link-2 i { vertical-align: middle; }

a.big-link-2:hover {
    background: #5f5f5f;
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
}

a.big-link-2:active {
    -moz-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
}

a.big-link-3 {
  display: inline-block;
    padding: 5px 22px;
    background: #3e0000;
    font-size: 18px;
    color: #fcfcfc;
    font-style: italic;
    line-height: 24px;
    text-decoration: none;
    -moz-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
}

a.big-link-3:hover {
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
}

a.big-link-3:active {
    -moz-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
}


/***** Top menu *****/
@media screen and (min-width: 771px){
    body{
                padding-top: 100px;
    }
    .control-panel {
    width: 100%;
    height: 40px;
    background: #5f5f5f;
    position: fixed;
    float: left;
    z-index: 12;
    top: 0px;
    left: 0px;
    padding-left:90px;
    padding-right:90px;
}
.Mprincipal {
    height: auto;
    float: right;
    margin: 0px;
}
.Mprincipal>li:hover {
    background: #fcfcfc;
    color: #3e0000;
    cursor:pointer;

}
.Mprincipal>li:hover>ul {
    height: auto;
    background: #fcfcfc;
    color: #3e0000;
    overflow-y: visible;
    cursor: pointer;
    border-bottom: 2px solid #3e0000;
}
.Msecundario {
    overflow:hidden;
    height:0px;
    margin-top: 8px;
    padding-left: 0px;
    width: 117%;
    float: left;
    background: #fcfcfc;
    color: #3e0000;
    margin-left: -10px;
    transition:height ease 1s;
}
.Msecundario > li:hover {
    background: #5f5f5f;
    float: left;
    width: 100%;
    color: #fcfcfc;
}

.control-panel li{
    list-style:none;
}
.Mprincipal >li {
    float: right;
    height: 40px;
    padding: 10px;
    font-size: 16px;
    background: #5f5f5f;
    color: #fcfcfc;
}
.Msecundario > li {
    padding: 5px;
}
.navbar {
  top: 40px;
  background: #fcfcfc;
  border: 0;
  -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
    position: fixed;
    z-index: 11;
    width: 100%;
    min-height: 30px !important;
    height:46px;
        border-bottom: 6px solid #3e0000;
            opacity: 0.92;
}
}
@media screen and (max-width: 770px){
.navbar {
    top: 56px;
    background: #fcfcfc;
    border: 0;
    -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
    position: relative;
    z-index: 11;
    width: 100%;
        border-bottom: 6px solid #3e0000;
}
    .control-panel {
    width: 100%;
    background: #5f5f5f;
    position: fixed;
    float: left;
    z-index: 12;
    top: 0px;
    left: 0px;
    padding-left:90px;
    padding-right:90px;
}
.Mprincipal {
    height: auto;
    float: right;
    margin: 0px;
}
.Mprincipal>li:hover {
    background: #fcfcfc;
    color: #3e0000;
    cursor:pointer;

}
.Mprincipal>li:hover>ul {
    height: auto;
    background: #fcfcfc;
    color: #3e0000;
    overflow-y: visible;
    cursor: pointer;
    border-bottom: 2px solid #3e0000;
}
.Msecundario {
    overflow:hidden;
    height:0px;
    margin-top: 8px;
    padding-left: 0px;
    width: 117%;
    float: left;
    background: #fcfcfc;
    color: #3e0000;
    margin-left: -10px;
    transition:height ease 1s;
}
.Msecundario > li:hover {
    background: #5f5f5f;
    float: left;
    width: 100%;
    color: #fcfcfc;
}

.control-panel li{
    list-style:none;
}
.Mprincipal >li {
    float: right;
    height: 40px;
    padding: 10px;
    font-size: 16px;
    background: #5f5f5f;
    color: #fcfcfc;
}
.Msecundario > li {
    padding: 5px;
}
}
ul.navbar-nav {
  font-size: 12px;
  color: #5f5f5f;
  text-transform: uppercase;
}

ul.navbar-nav li a { padding: 0px 20px; background: #fcfcfc; border-top: 5px solid #fcfcfc; color: #5f5f5f; }
ul.navbar-nav li.active a { background: rgba(240,240,240,0.5); border-color: #3e0000; color: #5f5f5f; }

ul.navbar-nav li a:hover, ul.navbar-nav li a:focus { background: #3e0000; border-color: #3e0000; color: #fcfcfc; outline: 0; }

.nav .open > a { background: rgba(240,240,240,0.5); border-color: #3e0000; color: #5f5f5f; }
.nav .open > a:hover, .nav .open > a:focus { background: #3e0000; border-color: #3e0000; color: #fcfcfc; }

ul.navbar-nav li a i { line-height: 35px; color: #aaa; }
ul.navbar-nav li a:hover i, ul.navbar-nav li a:focus i { color: #fcfcfc; }

.dropdown-menu {
  border: 0;
  -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
  -moz-box-shadow: 0 6px 10px rgba(0, 0, 0, .15); -webkit-box-shadow: 0 6px 10px rgba(0, 0, 0, .15); box-shadow: 0 6px 10px rgba(0, 0, 0, .15);
}

.dropdown-menu > .active > a { background: #fcfcfc; color: #5f5f5f; }
.dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus { background: rgba(240,240,240,0.5); color: #3e0000; }

ul.navbar-nav li .dropdown-menu a { padding-top: 0px; padding-bottom: 0px; }
ul.navbar-nav li.active .dropdown-menu a { background: rgba(240,240,240,0.5); color: #5f5f5f; border: 0; }
ul.navbar-nav li.active .dropdown-menu a:hover, 
ul.navbar-nav li.active .dropdown-menu a:focus { background: #3e0000; color: #fcfcfc; border: 0; }

ul.navbar-nav li.active .dropdown-menu > .active > a { background: #3e0000; color: #fcfcfc; border: 0; }
ul.navbar-nav li.active .dropdown-menu > .active > a:hover, 
ul.navbar-nav li.active .dropdown-menu > .active > a:focus { background: #3e0000; color: #fcfcfc; border: 0; }

.navbar>.container .navbar-brand { margin-left: 0; }

.navbar-brand {
  width: 167px;
  height: 106px;
  background: url(../img/logo.png) left center no-repeat;
  text-indent: -99999px;
}

/***** Slider *****/

.slider-container {
    margin: 0 auto;
    background: rgba(240,240,240,0.5) url(../img/pattern.jpg) left top repeat;
    -moz-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
}

.slider {
  padding-left: 5px;
  padding-right: 5px;
}

.flexslider {
    margin-top: 45px;
    margin-bottom: 55px;
    border: 6px solid #fcfcfc;
    -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
    -moz-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 -5px 15px 0 rgba(0,0,0,.05);
    -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 -5px 15px 0 rgba(0,0,0,.05);
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 -5px 15px 0 rgba(0,0,0,.05);
}

.flexslider .slides > li {
  position: relative;
  height:400px;
}

.flex-caption {
    position: absolute;
    left: 0;
    bottom: 20px;
    width: 95%;
    padding: 10px 20px;
    background: #1d1d1d; /* browsers that don't support rgba */
    background: rgba(0, 0, 0, .7);
    font-size: 14px;
    line-height: 24px;
    color: #eaeaea;
    text-align: left;
    font-style: italic;
}

.flex-direction-nav a {
  width: 60px;
  height: 60px;
  padding-top: 17px;
  background: #3e0000;
  color: #fcfcfc;
  text-shadow: none;
}

.flex-direction-nav a:before { font-size: 26px; }

.flex-direction-nav .flex-prev, .flex-direction-nav .flex-next { text-align: center; }


/***** Slider 2 *****/

.slider-2-container {
  padding: 180px 0;
}
.slider-2-text > div {
    margin-left: 20px !important;
    width: 100%;
    float: left;
}
.slider-2-text > div >* {
    opacity:0.8;
    margin: 0px !important;
    width: auto !important;
    float: left;
    background: #fcfcfc;
    color:#5f5f5f;
        border-radius: 0px;
    border-bottom: solid 1px;
}
.slider-2-text {
    padding: 30px 0 43px 0;
    color: #fcfcfc;
    margin-left: 0px !important;
    text-align: left;
}

.slider-2-text h1 {
padding-left: 30px;
    padding-right: 30px;
    font-family: 'Lobster', cursive;
    font-size: 70px;
    line-height: 70px;
    color: #3e0000;
    font-weight: bold;
    border-bottom: solid 1px #3e0000;
}

.slider-2-text p {
  padding-left: 30px;
  padding-right: 30px;
  font-size: 30px;
      line-height: 30px;

    font-style: italic;
    border-bottom: solid 1px;
}


/***** Presentation *****/

.presentation-container {
    margin-top: 30px;
}

.presentation-container h1 {
    font-family: 'Lobster', cursive;
    font-size: 30px;
    color: #5f5f5f;
    font-weight: bold;
}

.presentation-container p {
    font-size: 18px;
    font-style: italic;
}


/***** Services *****/

.services-container {
    margin-top: 10px;
}

.services-title {
  margin-top: 40px;
    background: url(../img/line.png) left center repeat-x;
}

.services-title h2 {
    width: 200px;
    margin: 0 auto;
    background: rgba(240,240,240,0.5);
    font-family: 'Lobster', cursive;
    font-size: 24px;
    color: #5f5f5f;
    font-weight: bold;
}

.service {
    padding: 15px 15px 20px 15px;
    background: #fcfcfc;
    border-bottom: 2px solid #fcfcfc;
}
.col-sm-6{
    padding:0px !important;
}

.service:hover {
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -o-transition: all .5s; -moz-transition: all .5s; -webkit-transition: all .5s; -ms-transition: all .5s; transition: all .5s;
}

.service .service-icon {
    font-size: 50px;
    line-height: 50px;
    color: #5f5f5f;
}

.service .service-icon i { vertical-align: middle; }

.service h3 {
    margin-top: 13px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 14px;
    color: #5f5f5f;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.service p {
    padding-bottom: 7px;
    line-height: 24px;
}


/***** Latest work *****/

.work-container {
    margin-top: 50px;
}

.work-title {
    background: url(../img/line.png) left center repeat-x;
}

.work-title h2 {
    width: 220px;
    margin: 0 auto;
    background: rgba(240,240,240,0.5);
    font-family: 'Lobster', cursive;
    font-size: 24px;
    color: #5f5f5f;
    font-weight: bold;
}

.work {
    margin-top: 40px;
    padding-bottom: 20px;
    background: rgba(240,240,240,0.5);
    border-bottom: 2px solid #3e0000;
}

.work:hover img {
    opacity: 0.7;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}

.work:hover {
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -o-transition: all .5s; -moz-transition: all .5s; -webkit-transition: all .5s; -ms-transition: all .5s; transition: all .5s;
}

.work .work-bottom {
    margin-top: 15px;
}

.work h3 {
    margin-top: 20px;
    padding-left: 15px;
    padding-right: 15px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 14px;
    color: #5f5f5f;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.work p {
  padding-left: 15px;
    padding-right: 15px;
    line-height: 24px;
    font-style: italic;
}


/***** Testimonials *****/

.testimonials-container {
    margin-top: 50px;
    padding-bottom: 70px;
}

.testimonials-title {
    background: url(../img/line.png) left center repeat-x;
}

.testimonials-title h2 {
    width: 180px;
    margin: 0 auto;
    background: #fcfcfc;
    font-family: 'Lobster', cursive;
    font-size: 24px;
    color: #5f5f5f;
    font-weight: bold;
}

.testimonial-list {
    margin-top: 30px;
    text-align: left;
}

.testimonial-list .tab-pane { overflow: hidden; }

.testimonial-list .testimonial-image {
  float: left;
  width: 10%;
  margin: 10px 0 0 0;
}
.testimonial-list .testimonial-image img { max-width: 64px; border: 3px solid #eaeaea; }

.testimonial-list .testimonial-text {
  float: left;
  width: 90%;
  font-size: 14px;
    line-height: 30px;
    font-style: italic;
}

.testimonial-list .nav-tabs {
    border: 0;
    text-align: right;
}

.testimonial-list .nav-tabs li {
  float: none;
  display: inline-block;
  margin-left: 2px;
    margin-right: 2px;
}

.testimonial-list .nav-tabs li a {
    width: 12px;
    height: 12px;
    padding: 0;
    background: rgba(240,240,240,0.5);
    border: 0;
    -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
}

.testimonial-list .nav-tabs li a:hover { border: 0; background: #3e0000; }
.testimonial-list .nav-tabs li.active a { background: #3e0000; }


/***** Footer *****/

footer {
    margin: 0 auto;
    padding-bottom: 10px;
    background: rgba(240,240,240,0.5) url(../img/pattern.jpg) left top repeat;
    -moz-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset; -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset; box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset;
}

.footer-box {
    margin-top: 20px;
    text-align: left;
}

.footer-box h4 {
    margin-top: 20px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 14px;
    color: #5f5f5f;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.footer-box-text p {
    line-height: 24px;
}

.footer-box-text-contact i {
    padding-right: 7px;
}

.footer-box-text-subscribe form {
  padding-bottom: 10px;
}

.footer-box-text-subscribe input[type="text"] {
  width: 95%;
  height: 26px;
}

/* Flickr feed */
.flickr-feed {
    margin: 16px 0 0 0;
}

.flickr-feed a {
  display: inline-block;
  width: 54px;
  margin: 0 4px 4px 0;
}
.flickr-feed a:hover { opacity: 0.7; }
.flickr-feed a img { border: 2px solid #eaeaea; }


.footer-border {
    margin-top: 30px;
    border-top: 1px dashed #ddd;
}

.footer-copyright {
    margin-top: 15px;
    line-height: 24px;
    text-align: left;
}

.footer-social {
    margin-top: 5px;
    text-align: right;
}
.footer-social a { margin: 0 0 0 10px; font-size: 26px; color: #5f5f5f; }
.footer-social a:hover, .footer-social a:focus { color: #3e0000; }


/***** Page title *****/

.page-title-container {
    margin: 0 auto;
    padding: 30px 0 35px 0;
    background: rgba(240,240,240,0.5) url(../img/pattern.jpg) left top repeat;
    text-align: left;
    -moz-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
}

.page-title-container h1 {
    display: inline;
    margin-left: 10px;
    font-family: 'Lobster', cursive;
    font-size: 24px;
    color: #5f5f5f;
    font-weight: bold;
    text-shadow: 0 1px 0 rgba(255, 255, 255, .7);
    vertical-align: middle;
}

.page-title-container p {
    display: inline;
    margin-left: 5px;
    font-size: 14px;
    font-style: italic;
    vertical-align: middle;
}

.page-title-container i {
    font-size: 46px;
    color: #ccc;
    vertical-align: middle;
}


/* ----- ABOUT PAGE ----- */

/***** About us text *****/

.about-us-container {
    margin-top: 20px;
}

.about-us-text {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: left;
}

.about-us-text h3 {
    margin-top: 25px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 16px;
    color: #5f5f5f;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.about-us-text p {
    line-height: 28px;
    font-size: 13px;
}

/***** Meet our team *****/

.team-container {
    margin-top: 30px;
}

.team-title {
    background: url(../img/line.png) left center repeat-x;
}

.team-title h2 {
    width: 220px;
    margin: 0 auto;
    background: #fcfcfc;
    font-family: 'Lobster', cursive;
    font-size: 24px;
    color: #5f5f5f;
    font-weight: bold;
}

.team-box {
    margin-top: 40px;
    padding-bottom: 15px;
    background: rgba(240,240,240,0.5);
    border-bottom: 2px solid #3e0000;
    overflow: hidden;
}


.team-box:hover img {
    opacity: 0.7;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}

.team-box:hover {
  -moz-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
  -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -o-transition: all .5s; -moz-transition: all .5s; -webkit-transition: all .5s; -ms-transition: all .5s; transition: all .5s;
}

.team-box h3 {
    margin-top: 20px;
    padding-left: 15px;
    padding-right: 15px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 14px;
    color: #5f5f5f;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.team-box p {
  padding-left: 15px;
    padding-right: 15px;
    line-height: 24px;
    font-style: italic;
}

.team-social a { margin: 0 5px; font-size: 26px; }


/* ----- CONTACT PAGE ----- */

/***** Form *****/

.contact-us-container {
    margin-top: 20px;
    padding-bottom: 50px;
    text-align: left;
}

.contact-us-container h3 {
    margin-top: 25px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 16px;
    color: #5f5f5f;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.contact-us-container p {
    line-height: 28px;
    font-size: 13px;
}

.contact-form {
    padding-top: 25px;
    padding-bottom: 30px;
}

.contact-form form {
    margin-top: 25px;
}

.contact-form form .form-group {
  margin-bottom: 20px;
}

.contact-form input[type="text"] { width: 95%; height: 34px; }
.contact-form textarea { width: 95%; height: 170px; padding-top: 6px; padding-bottom: 6px; }
.contact-form label { font-size: 13px; font-weight: 400; }
.contact-form label .error-label { font-style: italic }
.contact-form button { margin-top: 5px; padding: 0 45px; }

/***** Google map *****/

.contact-address {
  padding-bottom: 15px;
}

.contact-address .map {
    margin: 20px 0 40px 0;
    height: 300px;
    border: 5px solid rgba(240,240,240,0.5);
}


/* ----- SERVICES PAGE ----- */

/***** Services full width text *****/

.services-full-width-container {
    margin-top: 20px;
}

.services-full-width-text {
    padding-top: 10px;
    text-align: left;
}

.services-full-width-text h3 {
    margin-top: 25px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 16px;
    color: #5f5f5f;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.services-full-width-text p {
    line-height: 28px;
    font-size: 13px;
}

/***** Services half width text *****/

.services-half-width-container {
    margin-top: 20px;
}

.services-half-width-text {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: left;
}

.services-half-width-text h3 {
    margin-top: 25px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 16px;
    color: #5f5f5f;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.services-half-width-text p {
    line-height: 28px;
    font-size: 13px;
}

/***** Call to action *****/

.call-to-action-container {
    margin-top: 20px;
    padding-bottom: 50px;
}

.call-to-action-text {
    padding-top: 25px;
    padding-bottom: 15px;
    background: rgba(240,240,240,0.5);
    text-align: left;
    overflow: hidden;
}

.call-to-action-text:hover {
  -moz-box-shadow: 0 3px 10px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
  -webkit-box-shadow: 0 3px 10px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 3px 10px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -o-transition: all .5s; -moz-transition: all .5s; -webkit-transition: all .5s; -ms-transition: all .5s; transition: all .5s;
}

.call-to-action-text p {
    float: left;
    width: 80%;
    padding-left: 25px;
    line-height: 30px;
    font-size: 18px;
    font-style: italic;
}

.call-to-action-text .call-to-action-button {
    float: left;
    width: 20%;
    padding-right: 25px;
    margin-bottom: 10px;
    text-align: right;
}


/* ----- PORTFOLIO PAGE ----- */

.contenedor-clase {
    margin-top: 20px;
    padding-bottom: 50px;
}

.filters {
  padding-top: 35px;
  padding-bottom: 10px;
  font-family: 'Droid Sans', sans-serif;
    font-size: 16px;
    color: #5f5f5f;
    font-weight: bold;
    text-align: left;
    text-transform: uppercase;
    text-shadow: 0 1px 0 #fcfcfc;
}

.filters a { color: #5f5f5f; }
.filters a:hover, .filters a.active { color: #3e0000; }

.box {
  width: 255px;
  margin: 40px 15px 0 15px;
}

.box img {
  cursor: pointer;
  -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}
.box:hover img { opacity: 0.7; }

.box-container {
  position: relative;
  background: rgba(240,240,240,0.5);
    border-bottom: 2px solid #3e0000;
}

.box-container:hover {
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -o-transition: all .5s; -moz-transition: all .5s; -webkit-transition: all .5s; -ms-transition: all .5s; transition: all .5s;
}

.box-icon {
  position: absolute;
  top: 10px;
  right: 10px;
  width: 35px;
    height: 35px;
    padding-top: 7.5px;
    padding-left: 3px;
    background: #1d1d1d; /* browsers that don't support rgba */
    background: rgba(0, 0, 0, .7);
    font-size: 20px;
    color: #fcfcfc;
    line-height: 20px;
    -moz-border-radius: 19px; -webkit-border-radius: 19px; border-radius: 19px;
}

.box-text {
  padding: 0 15px 20px 15px;
}

.box-text h3 {
    margin-top: 20px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 14px;
    color: #5f5f5f;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.box-text p {
    line-height: 24px;
    font-style: italic;
}

