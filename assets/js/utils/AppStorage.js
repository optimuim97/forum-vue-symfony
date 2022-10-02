class AppStorage{
    
    storeToken(token){
        localStorage.setItem('token',token);
    }

    storeUser(user){
        localStorage.setItem('user',user);
    }

    storeData(user,token){
        this.storeUser(user);
        this.storeToken(token);
    }

    clear(){
        localStorage.removeItem('user');
        localStorage.removeItem('token');
    }

    getDatas()
    {
        user = localStorage.getItem('user');
        token = localStorage.getItem('token')

        console.log(user, token)

        return {
            "user" : user,
            "token" : token
        }
    }

    getUser(){
        user = localStorage.getItem('user')
        return user;
    }

    getToken(){
        const token = localStorage.getItem('token')
        return token;
    }
}

export default AppStorage = new AppStorage()