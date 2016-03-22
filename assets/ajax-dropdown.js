(function ($) {
    $.fn.ajaxDropdown = function (options) {
        if (typeof options === 'object' || !options) {
            return methods.init.apply(this, arguments);
        } else {
            console.error('Argument of jQuery.ajaxDropdown() is not an object.');
            return false;
        }
    };
    var defaults = {
        confirm: undefined,
        itemSelector: 'a',
        ajaxOptions: {
            method: 'PATCH',
            dataType: 'json',
            cache: false,
            success: function () {
                window.location.reload();
            }
        }
    };
    var methods = {
        init: function (options) {
            return this.each(function () {
                options = options || {};
                var $dropdown = $(this);
                var ajaxOptions = $.extend({}, defaults.ajaxOptions, options.ajaxOptions || {});
                options = $.extend({}, defaults, options, {ajaxOptions: ajaxOptions});
                $dropdown.data('ajaxDropdown', {options: options});
                $dropdown.on('click.ajaxDropdown', options.itemSelector, {
                    $dropdown: $dropdown
                }, methods.itemClick);
            });
        },
        itemClick: function (e) {
            var $item = $(this);
            var $dropdown = e.data.$dropdown;
            var options = $dropdown.data('ajaxDropdown').options;
            var ajaxOptions = $.extend(options.ajaxOptions, {data: $item.data()});
            if (
                options.confirm === undefined
                || (typeof options.confirm == 'string' && confirm(options.confirm))
                || (options.confirm instanceof Function && (methods.confirm = options.confirm))
            ) {
                methods.confirm.call(this, ajaxOptions);
            }
            e.preventDefault();
            return true;
        },
        confirm: function (options) {
            $.ajax(options);
        }
    };
})(window.jQuery);
