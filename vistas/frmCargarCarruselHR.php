<!DOCTYPE html>
<html lang="es">
<head>
    <script  src="../restaurante/CARRU/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script  src="../restaurante/CARRU/jsCarousel-2.0.0.js" type="text/javascript"></script>
    <link   href="../restaurante/CARRU/jsCarousel-2.0.0.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        $(document).ready(function() {

            $('#carouselv').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: true, masked: false, itemstodisplay: 3, orientation: 'v' });
            $('#carouselh').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: false, circular: true, masked: false, itemstodisplay: 5, orientation: 'h' });
            $('#carouselhAuto').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: true, masked: true, itemstodisplay: 5, orientation: 'h' });

        });       
        
    </script>

    <style type="text/css">
        #demo-wrapper
        {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            padding: 40px 20px 0px 20px;
        }
        #demo-left
        {
            width: 15%;
            float: left;
        }
        #demo-right
        {
            width: 85%;
            float: left;
        }
        #hWrapperAuto
        {
            margin-top: 20px;
        }
        #demo-tabs
        {
            width: 100%;
            height: 50px;
            color: White;
            margin: 0;
            padding: 0;
        }
        #demo-tabs div.item
        {
            height: 35px;
            float: left;
            background-color: #2F2F2F;
            border: solid 1px gray;
            border-bottom: none;
            padding: 0;
            margin: 0;
            margin-left: 10px;
            text-align: center;
            padding: 10px 4px 4px 4px;
            font-weight: bold;
        }
        #contents
        {
            width: 100%;
            margin: 0;
            padding: 0;
            color: White;
            font: arial;
            font-size: 11pt;
        }
        #demo-tabs div.item.active-tab
        {
            background-color: Black;
        }
        #demo-tabs div.item.active-tabc
        {
            background-color: Black;
        }
        #v1, #v2
        {
            margin: 20px;
        }
        .visible
        {
            display: block;
        }
        .hidden
        {
            display: none;
        }
        #oldWrapper
        {
            margin-left: 100px;
        }
        #contents a
        {
            color: yellow;
        }
        #contents a:hover
        {
            text-decoration: none;
            color: Gray;
        }
        .heading
        {
            font-size: 20pt;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div id="contents">
        <div id="v2">
              <div id="demo-wrapper">
                
                <div id="demo-right">
                  
                    <div id="hWrapperAuto">
                        <div id="carouselhAuto">
                            <div>
                                <img alt="" src="../restaurante/CARRU/images/img_1.jpg" /><br />
                                <span class="thumbnail-text">Image Text</span></div>
                            <div>
                                <img alt="" src="../restaurante/CARRU/images/img_2.jpg" /><br />
                                <span class="thumbnail-text">Image Text</span></div>
                            <div>
                                <img alt="" src="../restaurante/CARRU/images/img_3.jpg" /><br />
                                <span class="thumbnail-text">Image Text</span></div>
                            <div>
                                <img alt="" src="../restaurante/CARRU/images/img_4.jpg" /><br />
                                <span class="thumbnail-text">Image Text</span></div>
                            <div>
                                <img alt="" src="../restaurante/CARRU/images/img_5.jpg" /><br />
                                <span class="thumbnail-text">Image Text</span></div>
                            <div>
                                <img alt="" src="../restaurante/CARRU/images/img_6.jpg" /><br />
                                <span class="thumbnail-text">Image Text</span></div>
                            <div>
                                <img alt="" src="../restaurante/CARRU/images/img_7.jpg" /><br />
                                <span class="thumbnail-text">Image Text</span></div>
                            <div>
                                <img alt="" src="../restaurante/CARRU/images/img_8.jpg" /><br />
                                <span class="thumbnail-text">Image Text</span></div>
                            <div>
                                <img alt="" src="../restaurante/CARRU/images/img_9.jpg" /><br />
                                <span class="thumbnail-text">Image Text</span></div>
                            <div>
                                <img alt="" src="../restaurante/CARRU/images/img_10.jpg" /><br />
                                <span class="thumbnail-text">Image Text</span>
							</div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>