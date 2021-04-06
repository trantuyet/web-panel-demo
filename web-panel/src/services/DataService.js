import http from "../http-common";

class DataService {
    getAll() {
        return http.get("/user/");
    }

    create(data) {
        return http.post("user/register", data);
    }

    login(data) {
        return http.post("user/login", data);
    }

    update(id, data) {
        return http.put('user/${id}/edit', data);
    }

    delete(id) {
        return http.delete('user/${id}/delete');
    }

}

export default new DataService();
