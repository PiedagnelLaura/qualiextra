document.getElementById('toto').addEventListener(
    'scroll',
    function()
    {
        var scrollTop = document.getElementById('experience-hoteliere').scrollTop;
        var scrollHeight = document.getElementById('experience-hoteliere').scrollHeight; // added
        var offsetHeight = document.getElementById('experience-hoteliere').offsetHeight;
        // var clientHeight = document.getElementById('experience-hoteliere').clientHeight;
        var contentHeight = scrollHeight - offsetHeight; // added
        if (contentHeight <= scrollTop) // modified
        {
            document.getElementById('title').innerHTML = "another type";
        } else {
            document.getElementById('title').innerHTML = "Experience Hoteliere";
        }
    },
    false
)