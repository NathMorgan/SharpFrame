<div id="newroomwrapper" class="gradient-top">
    <h2>New Room</h2>
    {{ form("room/register", "method": "post", "enctype": "multipart/form-data") }}
        <div id="labels">
            <label for="title">Title:</label> <br />
            <label for="description">Description:</label> <br />
            <label for="youtubeurl">YouTube URL:</label> <br />
            <label for="icon">Icon:</label> <br />
        </div>
        <div id="inputs">
            {{ text_field("title") }} <br />
            {{ text_field("description") }} <br />
            {{ text_field("youtubeurl") }}<a href="#" class="fix-url">Paste</a> <br />
            {{ file_field("icon") }}
        </div>
        {{ submit_button("Submit") }}
    </form>
</div>