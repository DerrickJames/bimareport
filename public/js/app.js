$(document).ready(function(){
	$('#searchbox').selectize({
		valueField: 'url',
		labelField: 'first_name',
		searchField: ['first_name'],
		maxOptions: 10,
		options: [],
		create: false,
		render: {
			option: function(item, escape){
				return '<div>' + escape(item.first_name + " " + item.last_name) + '</div>';
			}
		},
		load: function(query, callback) {
			if (!query.length) return callback();
			$.ajax({
				url: root+'/api/search',
				type: 'GET',
				dataType: 'json',
				data: {
					q: query
				},
				error: function(){
					callback();
				},
				success: function(res){
					callback(res.data);
				} 
			});
		},
		onChange: function(){
			window.location = this.items[0];
		}
	});

	$('#transactionSearchBox').selectize({
		valueField: 'url',
		labelField: 'first_name',
		searchField: ['first_name'],
		maxOptions: 10,
		options: [],
		create: false,
		render: {
			option: function(item, escape){
				return '<div>' + escape(item.first_name + " " + item.last_name) + '</div>';
			}
		},
		load: function(query, callback) {
			if (!query.length) return callback();
			$.ajax({
				url: root+'/search',
				type: 'GET',
				dataType: 'json',
				data: {
					q: query
				},
				error: function(){
					callback();
				},
				success: function(res){
					callback(res.data);
				} 
			});
		},
		onChange: function(){
			window.location = this.items[0];
		}
	});
});