define(['knockout'], function(ko){
    var indexViewModel = function(){
        var that = this;

        that.person = ko.observableArray([]);

        that.inputNameValue = ko.observable('');
        that.inputAgeValue = ko.observable('');

        this.addPerson = function(){
            var obName = that.inputNameValue();
            var obAge = that.inputAgeValue();
            that.person.push({name: obName, age:obAge})
        }

        that.isAdd = ko.computed(function(){
            return (that.inputNameValue() != '' && that.inputAgeValue() != '') ? true : false;
        });

        that.delPerson = function(){
            that.person.remove(this);
        }

    }

    return indexViewModel;
})
