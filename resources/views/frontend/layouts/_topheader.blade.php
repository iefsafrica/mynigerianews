<div class="maan-top-bar">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-sm-6 col-md-9 col-xl-10 date-time">
                <div class="maan-current-date">
                    <span class="icon"><svg viewBox="0 0 477.867 477.867"><path d="M119.467,0C110.041,0,102.4,7.641,102.4,17.067V51.2h34.133V17.067C136.533,7.641,128.892,0,119.467,0z"></path><path d="M358.4,0c-9.426,0-17.067,7.641-17.067,17.067V51.2h34.133V17.067C375.467,7.641,367.826,0,358.4,0z"></path> <path d="M426.667,51.2h-51.2v68.267c0,9.426-7.641,17.067-17.067,17.067s-17.067-7.641-17.067-17.067V51.2h-204.8v68.267 c0,9.426-7.641,17.067-17.067,17.067s-17.067-7.641-17.067-17.067V51.2H51.2C22.923,51.2,0,74.123,0,102.4v324.267 c0,28.277,22.923,51.2,51.2,51.2h375.467c28.277,0,51.2-22.923,51.2-51.2V102.4C477.867,74.123,454.944,51.2,426.667,51.2z M443.733,426.667c0,9.426-7.641,17.067-17.067,17.067H51.2c-9.426,0-17.067-7.641-17.067-17.067V204.8h409.6V426.667z"></path><path d="M353.408,243.942c-6.664-6.669-17.472-6.672-24.141-0.009L204.8,368.401l-56.201-56.201 c-6.669-6.664-17.477-6.66-24.141,0.009c-6.664,6.669-6.66,17.477,0.009,24.141l68.267,68.267c6.665,6.663,17.468,6.663,24.132,0 L353.4,268.083C360.068,261.419,360.072,250.611,353.408,243.942z"></path></svg></span>
                    <span class="maan-current-week" id="maan-current-week-day"></span> {{ __(':') }} <span class="maan-current-day" id="maan-current-date"> </span>

                </div>
                <div class="digital-clock" id="clock"></div>


            </div>
            <div class="col-sm-4 col-md-3  col-xl-2">
                <div class="maan-social-link">
                    <ul>
                        @foreach($socials as $social)
                            <li><a href="{{$social->url}}"><i class="{{$social->icon_code}}"></i></a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function currentTime() {
        var date = new Date(); /* creating object of Date class */
        var hour = date.getHours();
        var min = date.getMinutes();
        var sec = date.getSeconds();
        hour = updateTime(hour);
        min = updateTime(min);
        sec = updateTime(sec);
        var midday = "AM";
        midday = (hour >= 12) ? "PM" : "AM";
        hour = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12): hour);
        document.getElementById("clock").innerText = hour + " : " + min + " : " + sec + " " + midday; /* adding time to the div */
        var t = setTimeout(function(){ currentTime() }, 1000); /* setting timer */
    }

    function updateTime(k) {
        if (k < 10) {
            return "0" + k;
        }
        else {
            return k;
        }
    }
    currentTime(); /* calling currentTime() function to initiate the process */
</script>
