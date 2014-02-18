<div id="newroomwrapper" class="gradient-top">
    <h2>New Room</h2>
    {{ form("room/register", "method": "post") }}
        <div id="labels">
            <label for="title">Title:</label> <br />
            <label for="description">Description:</label> <br />
            <label for="youtubeurl">YouTube URL:</label> <br />
            <label for="icon">Icon:</label> <br />
        </div>
        <div id="inputs">
            {{ text_field("title") }} <br />
            {{ text_field("description") }} <br />
            {{ text_field("youtubeurl") }} <br />
            {{ password_field("icon") }} <br />
        </div>
        {{ submit_button("Submit") }}
    </form>
</div>