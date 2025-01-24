import axios from "axios";

export default (cep) => {
    return axios.get(`https://viacep.com.br/ws/${cep}/json/`);
};
