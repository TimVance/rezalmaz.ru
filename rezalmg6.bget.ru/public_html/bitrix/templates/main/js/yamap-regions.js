ymaps.ready(function () {
	
	var coords = [55.838627,37.494719];
	var companyName = 'Компания «РезАлмаз»';
	
	var myMap = new ymaps.Map("regions-map", {
		center: coords,
		zoom: 8,
		behaviors: ['default', 'scrollZoom'],
		controls: ['smallMapDefaultSet']
	});
	
	var myPlacemark = new ymaps.Placemark(
		coords, {
			iconContent: companyName,
			balloonContentHeader: companyName,
			balloonContentBody: 'РезАлмаз'
		}, {
			draggable: false,
			preset: 'islands#blueStretchyIcon',
			hideIconOnBallon: false
		}
	);
	
	myMap.geoObjects.add(myPlacemark);
	
	
	// 	var myMap = new ymaps.Map("YMapsObjID", {
	// 		center: coords,
	// 		zoom: 12,
	// 		behaviors: ['default', 'scrollZoom'],
	// 		controls: ['smallMapDefaultSet']
	// 	});
	
	var customItemContentLayout = ymaps.templateLayoutFactory.createClass(
		'<div class=ballon_header>{{ properties.balloonContentHeader|raw }}</div>' +
		'<div class=ballon_body>{{ properties.balloonContentBody|raw }}</div>'
	);
	
	var clusterer = new ymaps.Clusterer({
		clusterDisableClickZoom: true,
		clusterOpenBalloonOnClick: true,
		clusterBalloonContentLayout: 'cluster#balloonCarousel',
		clusterBalloonItemContentLayout: customItemContentLayout,
		clusterBalloonPanelMaxMapArea: 0,
		clusterBalloonContentLayoutWidth: 250,
		clusterBalloonContentLayoutHeight: 130,
		clusterBalloonPagerSize: 5
	});
	
	myGeoObjects = [];
	
	$.ajax({
		url: "/regions/ajax_regions.php",
		type: "post",
		data: {'req':'regions'},
		dataType: 'json',
		success: function(data){

			

			for (var i=0; i<data.length; i++){
				var myPlacemark = new ymaps.Placemark([data[i]['coords'][0], data[i]['coords'][1]], {iconContent:'', balloonContentHeader:data[i]['region'], balloonContentBody: '<p><a href="' + data[i]['url'] + '">' + data[i]['name'] + '</a></p>' + '<p>' + data[i]['content'] + '</p>'}, {draggable:false});
				myGeoObjects.push(myPlacemark);
			}
			
			clusterer.add(myGeoObjects);
			myMap.geoObjects.add(clusterer);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// 					alert(xhr.status);
			alert(thrownError);
		},
	});
	
// 	var myPlacemark = new ymaps.Placemark([55.545166, 37.073220], {iconContent:'', balloonContentHeader:'Апрелевка', balloonContentBody: 'Алмазное бурение в Апрелевке'}, {draggable:false});
// 	myGeoObjects.push(myPlacemark);
// 	
// 	var myPlacemark = new ymaps.Placemark([55.796339, 37.938199], {iconContent:'', balloonContentHeader:'Балашиха', balloonContentBody: 'Алмазное бурение в Балашихе'}, {draggable:false});
// 	myGeoObjects.push(myPlacemark);
});