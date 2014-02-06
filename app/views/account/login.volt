{{ form("account/login", "method": "post") }}
    <label for="username">Username:</label>
    {{ text_field("q") }} <br />
    <label for="password">Password:</label>
    {{ password_field("password") }} <br />
    {{ submit_button("Login") }}
</form>