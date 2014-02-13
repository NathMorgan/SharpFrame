<div id="loginwrapper" class="gradient-top">
    <h2>Login</h2>
    {{ form("account/login", "method": "post") }}
        <label for="username">Username:</label>
        {{ text_field("q") }} <br />
        <label for="password">Password:</label>
        {{ password_field("password") }} <br />
        <label for="remember">Remember me?</label> <br />
        {{ submit_button("Login") }}
    </form>
</div>