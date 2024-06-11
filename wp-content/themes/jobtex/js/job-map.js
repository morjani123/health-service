(function($) {
    "use strict";
    
    var map, mapSidebar, markers, CustomHtmlIcon, group;
    var markerArray = [];

    $.extend($.apusThemeCore, {
        /**
         *  Initialize scripts
         */
        job_map_init: function() {
            var self = this;

            if ($('#jobs-google-maps').length) {
                L.Icon.Default.imagePath = 'wp-content/themes/jobtex/images/';
            }
            
            setTimeout(function(){
                self.mapInit('jobs-google-maps');

                self.getJobs('jobs-google-maps');
            }, 1000);
            
        },
        getJobs: function(map_e_id) {
            var self = this;
            if ( $('.widget-jobs-maps .jobs-google-maps').length ) {
                $('.widget-jobs-maps .jobs-google-maps').each(function(e){
                    var $this = $(this);
                    
                    $this.addClass('loading');
                    var $settings = $(this).data('settings');

                    var ajaxurl = jobtex_job_opts.ajaxurl;
                    if ( typeof wp_job_board_pro_opts.ajaxurl_endpoint !== 'undefined' ) {
                        var ajaxurl =  wp_job_board_pro_opts.ajaxurl_endpoint.toString().replace( '%%endpoint%%', 'jobtex_get_ajax_jobs' );
                    }
                    
                    $.ajax({
                        url: ajaxurl,
                        type:'POST',
                        dataType: 'html',
                        data: {
                            action: 'jobtex_get_ajax_jobs',
                            settings: $settings,
                        }
                    }).done(function(data) {
                        $this.removeClass('loading');
                        $this.closest('.widget-jobs-maps').find('.main-items-wrapper').html(data);
                        setTimeout(function(){
                            self.updateMakerCards(map_e_id);
                            map._onResize();
                        });
                    });
                });
            }
        },
        mapInit: function(map_e_id) {
            var self = this;

            var $window = $(window);

            if (!$('#' + map_e_id).length) {
                return;
            }

            map = L.map(map_e_id, {
                scrollWheelZoom: false
            });

            markers = new L.MarkerClusterGroup({
                showCoverageOnHover: false
            });

            if ($(window).width() > 1200) {
                var popupAnchor = [235, 38];
            } else{
                var popupAnchor = [0, -40];
            }

            CustomHtmlIcon = L.HtmlIcon.extend({
                options: {
                    html: "<div class='map-popup'></div>",
                    iconSize: [30, 30],
                    iconAnchor: [22, 30],
                    popupAnchor: popupAnchor,
                }
            });

            $window.on('pxg:refreshmap', function() {
                map._onResize();
                setTimeout(function() {
                    
                    if(markerArray.length > 0 ){
                        group = L.featureGroup(markerArray);
                        map.fitBounds(group.getBounds()); 
                    }
                }, 100);
            });

            $window.on('pxg:simplerefreshmap', function() {
                map._onResize();
            });

            if ( jobtex_job_map_opts.map_service == 'mapbox' ) {
                var tileLayer = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/'+jobtex_job_map_opts.mapbox_style+'/tiles/{z}/{x}/{y}?access_token='+ jobtex_job_map_opts.mapbox_token, {
                    attribution: " &copy;  <a href='https://www.mapbox.com/about/maps/'>Mapbox</a> &copy;  <a href='http://www.openstreetmap.org/copyright'>OpenStreetMap</a> <strong><a href='https://www.mapbox.com/map-feedback/' target='_blank'>Improve this map</a></strong>",
                    maxZoom: 18,
                });
            } else if ( jobtex_job_map_opts.map_service == 'here' ) {

                var hereTileUrl = 'https://2.base.maps.ls.hereapi.com/maptile/2.1/maptile/newest/'+jobtex_job_map_opts.here_style+'/{z}/{x}/{y}/512/png8?apiKey='+ jobtex_job_map_opts.here_map_api_key +'&ppi=320';
                var tileLayer = L.tileLayer(hereTileUrl, {
                    attribution: " &copy;  <a href='https://www.mapbox.com/about/maps/'>Here</a> &copy; <strong><a href='https://www.mapbox.com/map-feedback/' target='_blank'>Improve this map</a></strong>",
                    maxZoom: 18,
                });

            } else {
                if ( jobtex_job_map_opts.custom_style != '' ) {
                    try {
                        var custom_style = $.parseJSON(jobtex_job_map_opts.custom_style);
                        var tileLayer = L.gridLayer.googleMutant({
                            type: 'roadmap',
                            styles: custom_style
                        });

                    } catch(err) {
                        var tileLayer = L.gridLayer.googleMutant({
                            type: 'roadmap'
                        });
                    }
                } else {
                    var tileLayer = L.gridLayer.googleMutant({
                        type: 'roadmap'
                    });
                }
            }

            

            map.addLayer(tileLayer);

            // check archive/single page
            if ( !$('#' + map_e_id).is('.single-job-map') ) {
                self.updateMakerCards(map_e_id);
            } else {
                var $item = $('.single-listing-wrapper');
                
                if ( $item.data('latitude') !== "" && $item.data('latitude') !== "" ) {
                    var zoom = (typeof MapWidgetZoom !== "undefined") ? MapWidgetZoom : 15;
                    self.addMakerToMap($item);
                    map.addLayer(markers);

                    map.setView([$item.data('latitude'), $item.data('longitude')], zoom);
                    $(window).on('update:map', function() {
                        map.setView([$item.data('latitude'), $item.data('longitude')], zoom);
                    });
                } else {
                    $('#' + map_e_id).hide();
                }
            }
        },
        updateMakerCards: function(map_e_id) {
            var self = this;
            var $items = $('.main-items-wrapper .map-item');
            

            if ($('#' + map_e_id).length && typeof map !== "undefined") {

                if (!$items.length) {
                    map.setView([jobtex_job_map_opts.default_latitude, jobtex_job_map_opts.default_longitude], 12);
                    return;
                }

                map.removeLayer(markers);
                markers = new L.MarkerClusterGroup({
                    showCoverageOnHover: false
                });
                $items.each(function(i, obj) {
                    self.addMakerToMap($(obj), true);
                });

                map.addLayer(markers);

                if(markerArray.length > 0 ){
                    group = L.featureGroup(markerArray);
                    map.fitBounds(group.getBounds()); 
                }
            }
        },
        addMakerToMap: function($item, archive) {
            var self = this;
            var marker;

            if ( $item.data('latitude') == "" || $item.data('longitude') == "") {
                return;
            }

            if ( $item.data('img')) {
                var img_logo = "<img src='" + $item.data('img') + "' alt=''>";
                var mapPinHTML = "<div class='map-popup'><div class='icon-wrapper has-img is-job'>" + img_logo + "</div></div>";
            } else {
                var mapPinHTML = "<div class='map-popup'><div class='icon-wrapper is-candidate'></div></div>";
            }

            marker = L.marker([$item.data('latitude'), $item.data('longitude')], {
                icon: new CustomHtmlIcon({ html: mapPinHTML })
            });

            if (typeof archive !== "undefined") {

                $item.on('mouseenter', function() {
                    $(marker._icon).find('.map-popup').addClass('map-popup-selected');
                }).on('mouseleave', function(){
                    $(marker._icon).find('.map-popup').removeClass('map-popup-selected');
                });

                var customOptions = {
                    'maxWidth': '369',
                    'minWidth': '369',
                };

                var html_output = '';
                if ( $item.hasClass('job_listing') ) {
                    var logo_html = '';
                    if ( $item.data('img') ) {
                        logo_html = "<div class='employer-logo flex-shrink-0'><div class='image-wrapper image-loaded'>" +
                                    "<img src='" + $item.data('img') + "' alt=''>" +
                                "</div></div>";
                    }

                    var title_html = '';
                    if ( $item.find('.job-title').length ) {
                        title_html = "<h3 class='job-title'>" + $item.find('.job-title').html() + "</h3>";
                    }
                    var category_html = '';
                    if ( $item.find('.category-job').length ) {
                        category_html = "<div class='category-job'>" + $item.find('.category-job').html() + "</div>";
                    }
                    var location_html = '';
                    if ( $item.find('.job-location').length ) {
                        location_html = "<div class='job-metas'>" + $item.find('.job-location').html() + "</div>";
                    }

                    html_output = "<div class='maps-popup-style job-list layout-job'>" +
                        "<div class='inner d-flex align-items-center'>" + logo_html +
                            "<div class='job-list-content'>" + category_html + title_html + location_html + "</div>" +
                        "</div>" + 
                    "</div>";
                } else if ( $item.hasClass('employer') ) {
                    var logo_html = '';
                    if ( $item.data('img') ) {
                        logo_html = "<div class='employer-logo flex-shrink-0'><div class='image-wrapper image-loaded'>" +
                                    "<img src='" + $item.data('img') + "' alt=''>" +
                                "</div></div>";
                    }

                    var title_html = '';
                    if ( $item.find('.employer-title').length ) {
                        title_html = "<h3 class='job-title'>" + $item.find('.employer-title').html() + "</h3>";
                    }
                    var meta_html = '';
                    if ( $item.find('.employer-metas').length ) {
                        meta_html = "<div class='job-metas'>" + $item.find('.employer-metas').html() + "</div>";
                    }

                    var category_html = '';
                    if ( $item.find('.employer-category').length ) {
                        category_html = "<div class='employer-category'>" + $item.find('.employer-category').html() + "</div>";
                    }

                    html_output = "<div class='maps-popup-style job-list'>" +
                        "<div class='inner d-flex align-items-center'>" + logo_html +
                            "<div class='job-list-content'>" + category_html + title_html + meta_html + "</div>" +
                        "</div>" + 
                    "</div>";
                } else {
                    var logo_html = '';
                    if ( $item.data('img') ) {
                        logo_html = "<div class='employer-logo flex-shrink-0'><div class='image-wrapper image-loaded'>" +
                                    "<img src='" + $item.data('img') + "' alt=''>" +
                                "</div></div>";
                    }

                    var title_html = '';
                    if ( $item.find('.candidate-title').length ) {
                        title_html = "<h3 class='job-title'>" + $item.find('.candidate-title').html() + "</h3>";
                    }
                    var job_html = '';
                    if ( $item.find('.candidate-job').length ) {
                        job_html = "<div class='candidate-job'>" + $item.find('.candidate-job').html() + "</div>";
                    }

                    var meta_html = '';
                    if ( $item.find('.candidate-metas').length ) {
                        meta_html = "<div class='job-metas'>" + $item.find('.candidate-metas').html() + "</div>";
                    }

                    html_output = "<div class='maps-popup-style job-list candidate-archive-layout'>" +
                        "<div class='inner d-flex align-items-center'>" + logo_html +
                            "<div class='job-list-content'>" + job_html + title_html + meta_html + "</div>" +
                        "</div>" + 
                    "</div>";
                }

                marker.bindPopup(html_output, customOptions).openPopup();
            }

            markers.addLayer(marker);
            markerArray.push(L.marker([$item.data('latitude'), $item.data('longitude')]));
        },
        
    });

    $.apusThemeExtensions.job_map = $.apusThemeCore.job_map_init;

    
})(jQuery);
