<div id="roomlistwrapper">
    {% for index, room in rooms %}
    <a href="/room/view/{{room._id}}">
        <div class="roombox fix-url gradient-top" id="{{index}}">
            <div class="roomtitle">{{room.title}}</div>
            <img src="/public/content/icons/{{room.icon}}" />
        </div>
    </a>
   {% endfor %}
</div>