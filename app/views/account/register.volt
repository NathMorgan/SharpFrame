<div id="registerwrapper" class="gradient-top">
    <h2>Register</h2>
    {{ form("account/register", "method": "post") }}
        <label for="username">Username:</label>
        {{ text_field("username") }} <br />
        <label for="email">E-mail:</label>
        {{ email_field("email") }} <br />
        <label for="dob">Date of birth:</label>
        <input type="date" id="dob"> <br />
        <label for="password">Password:</label>
        {{ password_field("password") }} <br />
        <label for="repassword">Re-enter Password:</label>
        {{ password_field("repassword") }} <br />
        {{ submit_button("Register") }}
    </form>
</div>