<?php
?>
<style>
    a {
        color:black;
    }

    .schedule-sq {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

    }

    .workshop-sq {
        flex: 19%;
        height: auto;        padding-top:0;

        margin-bottom: 1%; /* (100-24*4)/2 */
        padding-right:2em;
        border-style: solid;
        border-width: 2px;
        border-radius: 0;
    }

    @media screen and (max-width: 600px) {
        .workshop {
            flex: 0 100%;
        }
        .workshop-sq {
            flex: 0 100%;
        }
    }

    .zoom-info-header-1{
        font-size: 1.1em;
        font-weight: 800;
        text-align: center;
        line-height:1.2;
        min-height: 1em;
        margin-bottom: .5em;
    }

    .zoom-info-header-2{
        font-size: .9em;
        font-weight: 600;
        text-align: center;
        line-height:1.2;
        min-height: 1em;
        margin-bottom: 0;
    }


    .zoom-info-content {
        font-size: 1.1em;
        font-weight: 600;
        text-align: center;
        line-height:1.2;
        min-height: 1em;
        margin-bottom: .5em;
    }

    .time {
        font-size:1.1em;
        font-weight:600;
        text-align: center;
    }

    .group {
        font-size: .9em;
        font-weight: 600;
        text-align: center;
        line-height:1;
        min-height: 2em;
        margin-bottom: .5em;
    }

    .title {
        color:#202020;
        font-size:1em;
        font-weight:800;
        text-align: center;
        line-height:1.3;
    }

    .subtitle {        color:#202020;
        font-size:.8em;

        text-align: center;
        line-height:1;
    }

    .zoom-info-content:hover {
        color: white;
    }
    .zoom-info-header-1:hover {
        color: white;
    }
    .zoom-info-header-2:hover {
        color: white;
    }
    .time:hover {
        color: white;
    }
    .group:hover {
        color: white;
    }
    .title:hover {
        color: white;
    }

    .room-1     {color:#0f8f8f;
    ;
    }
    .room-1-bg  {background-color:#8fffff;border-color:#0f8f8f;}
    .room-1-bg-img  {background-image: URL(/wp-content/uploads/2020/09/share-room-1.png);
        background-size: cover;}

    .room-2     {color:#0f8f0f;}
    .room-2-bg  {background-color:#8fff8f;border-color:#0f8f0f;}
    .room-2-bg-img  {background-image: URL(/wp-content/uploads/2020/09/share-room-2.png);
        background-size: 100%;}

    .room-3     {color:#8f0000;}
    .room-3-bg  {background-color:#ff8080;border-color:#8f0000;}

    .room-4     {color:#6f6f0f;}
    .room-4-bg  {background-color:#ffff8f;border-color:#6f6f0f;}
    .room-4-bg-img  {background-image: URL(/wp-content/uploads/2020/09/share-room-3.png);
        background-size: 100%;}

    .room-5     {color:#9f0f9f;}
    .room-5-bg  {background-color:#ff8fff;border-color:#af2faf;}
    .room-5-bg-img  {background-image: URL(/wp-content/uploads/2020/09/share-room-4.png);
        background-size: 100%;}

    .room-0     {color:#0f0f8f;}
    .room-0-bg  {background-color:#8f8fff;border-color:#0f0f8f;}


    tr:nth-child(even) {
        background-color: inherit;
    }

    tr:nth-child(odd) {
        background-color: inherit;
    }

    .clear-bg-color {background-color:#00000000;}
</style>

/****** FLEX BOX - SQUARE CORNERS *****/
<div id="schedule-sq">

    <div id="room1" class="workshop-sq room-1-bg">
        <a href="https://zoom.us/j/8358353466?pwd=Q2w2SnhLOEZsSEtEcHFvMHlZcVZXZz09">
            <dl class="room-1-bg  zoom-info clear-bg-color" >
                <dd class="zoom-info-header-1 room-1"><b>ROOM 1</b></dd>
                <dd class="zoom-info-header-2 room-1">Mtg ID:</dd>
                <dd class="zoom-info-content room-1">835 8353 466</dd>
                <dd class="zoom-info-header-2 room-1">Passcode:</dd>
                <dd class="zoom-info-content room-1">100420</dd>
                <dd class="zoom-info-header-2 room-1">Dial In:</dd>
                <dd class="zoom-info-content room-1">+1 929 205 6099</dd>
            </dl></a>
    </div>

    <div id="room2" class="workshop-sq room-2-bg">
        <a href="https://zoom.us/j/8291799564?pwd=RmVFVUhFS3p3V2NoVWFlUWdCYkdXZz09">
            <dl class="room-2-bg  zoom-info clear-bg-color" >
                <dd class="zoom-info-header-1 room-2"><b>ROOM 2</b></dd>
                <dd class="zoom-info-header-2 room-2">Mtg ID:</dd>
                <dd class="zoom-info-content room-2">829 179 9564</dd>
                <dd class="zoom-info-header-2 room-2">Passcode:</dd>
                <dd class="zoom-info-content room-2">100420</dd>
                <dd class="zoom-info-header-2 room-2">Dial In:</dd>
                <dd class="zoom-info-content room-2">+1 929 205 6099</dd>
            </dl></a>
    </div>

    <div id="room3" class="workshop-sq room-3-bg">
        <a href="https://zoom.us/j/2609869794?pwd=UDZXQW1mNGZUNHduNVpFRlB1SmVzZz09">
            <dl class="room-3-bg  zoom-info clear-bg-color" >
                <dd class="zoom-info-header-1 room-3"><b>ROOM 3</b></dd>
                <dd class="zoom-info-header-2 room-3">Mtg ID:</dd>
                <dd class="zoom-info-content room-3">260 986 9794</dd>
                <dd class="zoom-info-header-2 room-3">Passcode:</dd>
                <dd class="zoom-info-content room-3">100420</dd>
                <dd class="zoom-info-header-2 room-3">Dial In:</dd>
                <dd class="zoom-info-content room-3">+1 929 205 6099</dd>
            </dl></a>
    </div>

    <div id="room4" class="workshop-sq room-4-bg">
        <a href="https://zoom.us/j/8951963645?pwd=dXh2MW9KQmtsWXZDWnJGL0F4dkRlZz09">
            <dl class="room-4-bg  zoom-info clear-bg-color" >
                <dd class="zoom-info-header-1 room-4"><b>ROOM 4</b></dd>
                <dd class="zoom-info-header-2 room-4">Mtg ID:</dd>
                <dd class="zoom-info-content room-4">895 196 3645</dd>
                <dd class="zoom-info-header-2 room-4">Passcode:</dd>
                <dd class="zoom-info-content room-4">100420</dd>
                <dd class="zoom-info-header-2 room-4">Dial In:</dd>
                <dd class="zoom-info-content room-4">+1 929 205 6099</dd>
            </dl></a>
    </div>

    <div id="room5" class="workshop-sq room-5-bg">
        <a href="https://zoom.us/j/3274837445?pwd=RzY4Q1VoR2xlVGdDMlZrOFh2Ry9HQT09 ">
            <dl class="room-5-bg  zoom-info clear-bg-color" >
                <dd class="zoom-info-header-1 room-5"><b>ROOM 5</b></dd>
                <dd class="zoom-info-header-2 room-5">Mtg ID:</dd>
                <dd class="zoom-info-content room-5"">327 483 7445</dd>
                <dd class="zoom-info-header-2 room-5">Passcode:</dd>
                <dd class="zoom-info-content room-5"">100420</dd>
                <dd class="zoom-info-header-2 room-5">Dial In:</dd>
                <dd class="zoom-info-content room-5"">+1 929 205 6099</dd>
            </dl></a>
    </div>

    <div class="workshop-sq room-1-bg">
        <a href="https://zoom.us/j/8358353466?pwd=Q2w2SnhLOEZsSEtEcHFvMHlZcVZXZz09">
            <dl>
                <dd class="time room-1">9am</dd>
                <dd class="group room-1">Smithtown Afternoon Group</dd>
                <dd class="title">Sobriety During Pandemic </dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-2-bg">
        <a href="https://zoom.us/j/8291799564?pwd=RmVFVUhFS3p3V2NoVWFlUWdCYkdXZz09">
            <dl>
                <dd class="time room-2">9am</dd>
                <dd class="group room-2">Reflections 90</dd>
                <dd class="title">Reflections</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-3-bg">
        <a href="https://zoom.us/j/2609869794?pwd=UDZXQW1mNGZUNHduNVpFRlB1SmVzZz09">
            <dl>
                <dd class="time room-3">9am</dd>
                <dd class="group room-3">Stony Brook Freethinkers</dd>
                <dd class="title">Secular Sobriety</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-4-bg">
        <a href="https://zoom.us/j/8951963645?pwd=dXh2MW9KQmtsWXZDWnJGL0F4dkRlZz09">
            <dl>
                <dd class="time room-4">9am</dd>
                <dd class="group room-4">Lake Ronkonkoma Group</dd>
                <dd class="title">Am I Different?</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-5-bg">
        <a href="https://zoom.us/j/3274837445?pwd=RzY4Q1VoR2xlVGdDMlZrOFh2Ry9HQT09 ">
            <dl>
                <dd class="time room-5">9am</dd>
                <dd class="group room-5">Alanon</dd>
                <dd class="title">Gratitude and Joy</dd>
            </dl></a>
    </div>

    <div class="workshop-sq room-1-bg">
        <a href="https://zoom.us/j/8358353466?pwd=Q2w2SnhLOEZsSEtEcHFvMHlZcVZXZz09">
            <dl>
                <dd class="time room-1">10am</dd>
                <dd class="group room-1">Fort Salonga</dd>
                <dd class="title">Selective Memory of the Alcoholic</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-2-bg">
        <a href="https://zoom.us/j/8291799564?pwd=RmVFVUhFS3p3V2NoVWFlUWdCYkdXZz09">
            <dl>
                <dd class="time room-2">10am</dd>
                <dd class="group room-2">Longwood Love and Service</dd>
                <dd class="title">Freedom Through Service</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-3-bg">
        <a href="https://zoom.us/j/2609869794?pwd=UDZXQW1mNGZUNHduNVpFRlB1SmVzZz09">
            <dl>
                <dd class="time room-3">10am</dd>
                <dd class="group room-3">East Northport 164</dd>
                <dd class="title">Practical Application of the Twelfth Step</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-4-bg">
        <a href="https://zoom.us/j/8951963645?pwd=dXh2MW9KQmtsWXZDWnJGL0F4dkRlZz09">
            <dl>
                <dd class="time room-4">10am</dd>
                <dd class="group room-4">Port Jefferson Into Action</dd>
                <dd class="title">Into Action</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-5-bg">
        <a href="https://zoom.us/j/3274837445?pwd=RzY4Q1VoR2xlVGdDMlZrOFh2Ry9HQT09 ">
            <dl>
                <dd class="time room-5">10am</dd>
                <dd class="group room-5">Alanon</dd>
                <dd class="title">My Path to Serenity With a Higher Power</dd>
            </dl></a>
    </div>

    <div class="workshop-sq room-1-bg">
        <a href="https://zoom.us/j/8358353466?pwd=Q2w2SnhLOEZsSEtEcHFvMHlZcVZXZz09">
            <dl>
                <dd class="time room-1">11am</dd>
                <dd class="group room-1">Connect the Dots</dd>
                <dd class="title">Recovery</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-2-bg">
        <a href="https://zoom.us/j/8291799564?pwd=RmVFVUhFS3p3V2NoVWFlUWdCYkdXZz09">
            <dl>
                <dd class="time room-2">11am</dd>
                <dd class="group room-2">Southampton First Things First</dd>
                <dd class="title">First Things First</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-3-bg">
        <a href="https://zoom.us/j/2609869794?pwd=UDZXQW1mNGZUNHduNVpFRlB1SmVzZz09">
            <dl>
                <dd class="time room-3">11am</dd>
                <dd class="group room-3">Saint James Sunrise Reflections</dd>
                <dd class="title">Sobriety in the Professional World</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-4-bg">
        <a href="https://zoom.us/j/8951963645?pwd=dXh2MW9KQmtsWXZDWnJGL0F4dkRlZz09">
            <dl>
                <dd class="time room-4">11am</dd>
                <dd class="group room-4">Brentwood Ladies</dd>
                <dd class="title">Freedom That Recovery Brings Me</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-5-bg">
        <a href="https://zoom.us/j/3274837445?pwd=RzY4Q1VoR2xlVGdDMlZrOFh2Ry9HQT09 ">
            <dl>
                <dd class="time room-5">11am</dd>
                <dd class="group room-5">Alanon</dd>
                <dd class="title">Beyond the 12 Steps: Everyday Life</dd>
            </dl></a>
    </div>

    <div class="workshop-sq room-1-bg">
        <a href="https://zoom.us/j/8358353466?pwd=Q2w2SnhLOEZsSEtEcHFvMHlZcVZXZz09">
            <dl>
                <dd class="time room-1">12pm</dd>
                <dd class="group room-1">Eye Opener</dd>
                <dd class="title">Forgiveness: practicing the code of love and tolerance</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-2-bg">
        <a href="https://zoom.us/j/8291799564?pwd=RmVFVUhFS3p3V2NoVWFlUWdCYkdXZz09">
            <dl>
                <dd class="time room-2">12pm</dd>
                <dd class="group room-2">SIA Archives</dd>
                <dd class="title">Let's Share a Favorite AA Story With Each Other</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-3-bg">
        <a href="https://zoom.us/j/2609869794?pwd=UDZXQW1mNGZUNHduNVpFRlB1SmVzZz09">
            <dl>
                <dd class="time room-3">12pm</dd>
                <dd class="group room-3">Smithtown Serenity</dd>
                <dd class="title">Getting Involved with AA Beyond the Group Level</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-4-bg">
        <a href="https://zoom.us/j/3274837445?pwd=RzY4Q1VoR2xlVGdDMlZrOFh2Ry9HQT09 ">
            <dl>
                <dd class="time room-5">12pm</dd>
                <dd class="group room-5">Suffolk General Services</dd>
                <dd class="title">TBA TBA TBA</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-0-bg">
        <a href="https://zoom.us/j/99442960097?pwd=MjFmZVc0K3o2VG1nYWZwaXBSbTZrQT09">
            <dl>
                <dd class="time room-0">12pm</dd>
                <dd class="group room-0">Fellowship Room</dd>
                <dd class="title">Fellowship Room</dd>
            </dl></a>
    </div>

    <div class="workshop-sq room-1-bg">
        <a href="https://zoom.us/j/8358353466?pwd=Q2w2SnhLOEZsSEtEcHFvMHlZcVZXZz09">
            <dl>
                <dd class="time room-1">1pm</dd>
                <dd class="group room-1">Lindenhurst Group</dd>
                <dd class="title">Read the Labels: Being Careful with Over-the-Counter Medication</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-2-bg">
        <a href="https://zoom.us/j/8291799564?pwd=RmVFVUhFS3p3V2NoVWFlUWdCYkdXZz09">
            <dl>
                <dd class="time room-2">1pm</dd>
                <dd class="group room-2">Home for Dinner</dd>
                <dd class="title">Prayer</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-3-bg">
        <a href="https://zoom.us/j/2609869794?pwd=UDZXQW1mNGZUNHduNVpFRlB1SmVzZz09">
            <dl>
                <dd class="time room-3">1pm</dd>
                <dd class="group room-3">Bridge To Sobriety</dd>
                <dd class="title">ABC: Amends Basics and Change</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-4-bg">
        <a href="https://zoom.us/j/8951963645?pwd=dXh2MW9KQmtsWXZDWnJGL0F4dkRlZz09">
            <dl>
                <dd class="time room-5">1pm</dd>
                <dd class="group room-5">Sunrise Sobriety</dd>
                <dd class="title">Robert’s Rule of Order</dd>
            </dl></a>
    </div>
    <div class="workshop-sq room-5-bg">
        <a href="https://zoom.us/j/3274837445?pwd=RzY4Q1VoR2xlVGdDMlZrOFh2Ry9HQT09 ">
            <dl>
                <dd class="time room-4">1pm</dd>
                <dd class="group room-4">Alanon</dd>
                <dd class="title">Sponsorship and &ldquo;Working the Program&rdquo;</dd>
            </dl></a>
    </div>

</div>

<div class="workshop-sq room-0-bg">
    <a href="https://zoom.us/j/99442960097?pwd=MjFmZVc0K3o2VG1nYWZwaXBSbTZrQT09">
        <dl>
            <dd class="time room-0">2pm</dd>
            <dd class="group room-0">Main Room</dd>
            <dd class="group room-0">Mtg ID: 994 4296 0097 – Passcode: 100420  – 1-tap-mobile: +19292056099,,99442960097# </dd>
            <dd class="title" style="font-size:2em;">Keynote Speakers</dd>
        </dl></a>
</div>
