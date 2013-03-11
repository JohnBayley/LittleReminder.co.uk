<script>
window.onload=function()
{
    // initialize the library with your Facebook API key
    FB.init({ apiKey: 'b65c1efa72f570xxxxxxxxxxxxxxxxx' });

    //Fetch the status so that we can log out.
    //You must have the login status before you can logout,
    //and if you authenticated via oAuth (server side), this is necessary.
    //If you logged in via the JavaScript SDK, you can simply call FB.logout()
    //once the login status is fetched, call handleSessionResponse
    FB.getLoginStatus(handleSessionResponse);
}

//handle a session response from any of the auth related calls
function handleSessionResponse(response) {
    //if we dont have a session (which means the user has been logged out, redirect the user)
    if (!response.session) {
        window.location = "/mysite/Login.aspx";
        return;
    }

    //if we do have a non-null response.session, call FB.logout(),
    //the JS method will log the user out of Facebook and remove any authorization cookies
    FB.logout(handleSessionResponse);
}
</script>