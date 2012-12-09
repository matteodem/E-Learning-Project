$(document).ready(function(){
    function createKeyboardBindings(thisObj) {
        switch ($(thisObj).attr('class').split('Side')[0]) {
            case 'right':
                key = '→/d';
                break;
            case 'front':
                key = '←/a';
                break;
            case 'bottom':
                key = '↓/s';
                break;
            default:
                key = '';
                break;
        }

        if (key.length != 0) {
            jwerty.key(key, function(e) {
                e.preventDefault();
                $("section.active div").removeClass();
                $('section.active div').addClass("show-" + $(thisObj).attr('class').split('Side')[0]);
            });
        }
    }    
    
    function showNextCard() {
        $('section.active').next().addClass('active').removeClass('hidden');
        $('section.active').first().addClass('hidden').removeClass('active');
        
        if ($('section.active').length === 0) {
            $('#learnRow').addClass('hidden');
            $('#completedDiv').removeClass('hidden');
            return false;
        }
        
        $('section.active figure').each(function() {
            createKeyboardBindings(this);
        });        
    }
    
    function showPreviousCard() {
        $('section.active').prev().addClass('active').removeClass('hidden');
        $($('section.active')[1]).first().addClass('hidden').removeClass('active');
    
        if ($('section.active').length === 0) {
            return false;
        }
    
        $('section.active figure').each(function() {
            createKeyboardBindings(this);
        });
    }
    
    function switchCardSite(element, thisObj) {
        element.preventDefault();
        $("section.active div").removeClass();
        $('section.active div').addClass($(thisObj).val());
    }
    
    // Keyboard Listeners for switching beetween cards (n = next, b = previous)
    $('section.active figure').each(function() {
        createKeyboardBindings(this);
    });
    
    jwerty.key('n', function() {
        showNextCard();
    });
    
    jwerty.key('b', function() {
        showPreviousCard();
    });
    
    // Click Listeners (usable on mobile)
    $('#prevCardButton').click(function(e) {
        showPreviousCard();
    });
    
    $('#nextCardButton').click(function(e) {
        showNextCard();
    });
    
    $('#frontSideButton, #backSideButton, #cardboxButton').click(function(e) {
        switchCardSite(e, this);
    });
});