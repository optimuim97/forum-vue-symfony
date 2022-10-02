import AppStorage from "./AppStorage.js";
import Token from "./Token.js";

class User {

    login(data) {

        console.log("Sended datas ...")
        console.log(data)

        axios
            .post("api/login_check", data)
            .then((res) => {
                console.log("login response...")

                if(res){
                    console.log('success response ...')
                    console.log(res)
                }

                this.responseAfterLogin(res);
            })
            .catch((error) => (error) => {
                alert("Error");
                console.log(error.data);

                return error.data;
            });
    }

    responseAfterLogin(res) {      
        console.log("response after login ...")
        const access_token = res.data.access_token;
        const username = res.data.user;

        if (Token.isValid(access_token)) {
            AppStorage.storeData(username, access_token);

            window.location="/login"
        } else {
            alert("User is not valid");
            return false;
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();

        if (storedToken) {
            return Token.isValid(storedToken) ? true : false;
        }

        return false;
    }

    loggIn() {
        return this.hasToken();
    }

    redirectToHome(){
        window.location="/forum"
    }

    logout() {
        AppStorage.clear();
        window.location = "/login";
    }

    name() {
        if (this.loggIn()) {
            return AppStorage.getUser();
        }
    }

    id() {
        if (this.loggIn()) {
            const token = AppStorage.getToken();
            const payload = Token.payload(token);

            if (Token.isValid(token)) {
                return payload.sub;
            }
        } else {
            alert("User is not loggin");
        }
    }

    own(user_id){
        return this.id() == user_id
    }
}

export default User = new User();
