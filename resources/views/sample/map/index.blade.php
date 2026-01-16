<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    @php
        // dump($pensions);
    @endphp


    <div id="map" style="width:70%; height:400px; margin: auto;"></div>



    <div style="position: absolute; margin: -39px 0px 0px -14px; z-index: 0; left: 501px; top: 295px;"><img
            style="min-width: 0px; min-height: 0px; max-width: 99999px; max-height: none; border: 0px; display: block; position: absolute; user-select: none; clip: rect(0px, 29px, 42px, 0px); top: 0px; left: 0px; width: 29px; height: 42px;"
            draggable="false" src="http://t1.daumcdn.net/mapjsapi/images/2x/marker.png" alt=""
            role="presentation" title=""><img src="http://t1.daumcdn.net/mapjsapi/images/2x/transparent.gif"
            alt="" role="presentation"
            style="min-width: 0px; min-height: 0px; max-width: 99999px; max-height: none; border: 0px; display: block; position: absolute; user-select: none; width: 29px; height: 42px;"
            draggable="false" usemap="#daum.maps.Marker.Area:a"><map id="daum.maps.Marker.Area:a"
            name="daum.maps.Marker.Area:a"><area href="javascript:void(0)" alt="" role="presentation"
                shape="poly" coords="14,39,9,27,4,21,1,16,1,10,4,4,11,0,18,0,25,4,28,10,28,16,25,21,20,27"
                title=""></map></div>



    <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=49f49d684621b554bb7e4382786b3e46&libraries=services"></script>
    <script>
        var mapContainer = document.getElementById('map');
        mapOption = {
            center: new kakao.maps.LatLng(37.563082626819295, 127.19287264787243), // 초기 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };

        var map = new kakao.maps.Map(mapContainer, mapOption);

        var pensions = @json($pensions);
        pensions.forEach(function(pension) {
            // 각 펜션의 위치로 마커 생성
            var markerPosition = new kakao.maps.LatLng(pension.lat, pension.lng);

            var imageSrc = '{{ asset('assets/img/marker/sample_pin.png') }}'
                imageSize = new kakao.maps.Size(30, 30), // 마커이미지 크기
                imageOption = {
                    offset: new kakao.maps.Point(13, 35) // 마커 위치 기준점 마커 크기 줄일거면 같이 비율 맞춰야함
                };
            // 커스텀 마커 이미지
            var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption);

            var marker = new kakao.maps.Marker({
                position: markerPosition,
                image: markerImage // 커스텀 마커 이미지 적용함
            });
            // 지도에 마커 표시
            marker.setMap(map);
        });
    </script>
</body>

</html>
