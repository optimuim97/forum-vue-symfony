import AppStorage from "./AppStorage.js";
import Token from "./Token.js";
import router from '../routes.js';

class User {

    
    login(data) 
    {

        var username_ = data.username;

        console.log("Sended datas ...")
        // console.log(data)

        axios
            .post("api/login_check", data)
            .then((res) => {
                console.log("login response...")
                const access_token = res.data.token;
                const username = username_;
                console.log("res.data ...")
                console.log(res)
                console.log("response after login ...")
                console.log(">>>>>UserName<<<<", ">>>>>Access Token<<<<<")
                console.log(username_, access_token)
                
                
                if (Token.isValid(access_token)) {
                    AppStorage.storeData(username, access_token);
                    EventBus.$emit('login')       
                    console.log(this.loggIn())                    
                } else {
                    alert("User is not valid");
                    return false;
                }

            })
            .catch((error) => (error) => {
                alert("Error");
                console.log(error.data);

                return error.data;
            });
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
