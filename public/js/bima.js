(function(){

	window.App = {
		Models 		: {},
		Collections	: {},
		Views		: {},
	};

	window.template = function(id){
		return _.template($('#' + id).html());
	};

	App.Models.Task 		= Backbone.Model.extend({});

	App.Collections.Tasks	= Backbone.Collection.extend({
		model: App.Models.Task,
		url: '/'
	});

	App.Views.Tasks = Backbone.View.extend({
		tagName: 'ul',

		render: function() {
			this.collection.each(this.addOne, this);
			return this;
		},

		addOne: function(task){
			var taskView = new App.Views.Task({ model: task });

			this.$el.append(taskView.render().el);
		}
	}); 

	App.Views.Task	= Backbone.View.extend({
		tagName: 'li',

		render: function(){
			this.$el.html( this.model.get('title') );
			return this;
		}
	});

	var tasksCollection = new App.Collections.Tasks([
		{
			title: 'Learn Laravel',
			priority: 1
		},
		{
			title: 'Learn Backbone',
			priority: 2
		},
		{
			title: 'Learn Symfony',
			priority: 3
		}
	]);

	var tasksView = new App.Views.Tasks({ collection: tasksCollection });
	// tasksView.render();
	// console.log(tasksView.el);
	$('.tasks').html(tasksView.render().el);

})();