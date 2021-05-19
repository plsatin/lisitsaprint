

jQuery(document).ready(function() {
    var position = new google.maps.LatLng(56.771552, 60.631721);
    $('.map').gmap({'center': position,'zoom': 15, 'disableDefaultUI':true, 'callback': function() {
            var self = this;
            self.addMarker({'position': this.get('map').getCenter() });	
        }
    }); 
});


/*
    Pretty Photo
*/
jQuery(document).ready(function() {
    $("a[rel^='prettyPhoto']").prettyPhoto({social_tools: false});
});


/*
    Contact form
*/
jQuery(document).ready(function() {
    $('.contact-form form').submit(function() {

        $('.contact-form form .nameLabel').html('Имя');
        $('.contact-form form .emailLabel').html('Email');
        $('.contact-form form .messageLabel').html('Сообщение');

        var postdata = $('.contact-form form').serialize();
        $.ajax({
            type: 'POST',
            url: '/sendEmail',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                if(json.result == 'success') {
                    $('.contact-form form').fadeOut('fast', function() {
                        $('.contact-form').append('<p><span class="violet">Спасибо, что написали нам!</span> В ближайшее время мы свяжемся с вами.</p>');
                    });

                }
                if(json.result == 'failure') {
                    $('.contact-form form #messageWarning').append(' - <span class="violet" style="font-size: 13px; font-style: italic"> ' + json.name + '</span>');
                    $('.contact-form form #messageWarning').append(' - <span class="violet" style="font-size: 13px; font-style: italic"> ' + json.email + '</span>');
                    $('.contact-form form #messageWarning').append('<code><h4 class="ae-u-bolder"><span style="font-style: italic"> ' + json.message + '</span></h4></code>');

                }

            }

        });
        return false;
    });
});

