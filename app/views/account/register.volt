<div id="registerwrapper" class="gradient-top">
    <h2>Register</h2>
    {{ form("account/register", "method": "post") }}
        <div id="labels">
            <label for="username">Username:</label> <br />
            <label for="email">E-mail:</label> <br />
            <label for="dob">Date of birth:</label> <br />
            <label for="password">Password:</label> <br />
            <label for="repassword">Re-enter Password:</label> <br /> <br />
        </div>
        <div id="inputs">
            {{ text_field("username") }} <br />
            {{ email_field("email") }} <br />
            <input type="date" id="dob" name="dob"> <br />
            {{ password_field("password") }} <br />
            {{ password_field("repassword") }} <br />
        </div>
        {{ submit_button("Register") }}
    </form>
</div>