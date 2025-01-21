export default () => {
    const phoneFormat = (phone) => {
        const sanitizedPhone = phone.replace(/\D/g, "");

        return sanitizedPhone.length === 11
            ? sanitizedPhone.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3")
            : sanitizedPhone.length === 10
            ? sanitizedPhone.replace(/^(\d{2})(\d{4})(\d{4})$/, "($1) $2-$3")
            : sanitizedPhone.length === 9
            ? sanitizedPhone.replace(/^(\d{5})(\d{4})$/, "$1-$2")
            : sanitizedPhone.length === 8
            ? sanitizedPhone.replace(/^(\d{4})(\d{4})$/, "$1-$2")
            : phone;
    };

    const cepFormat = (cep) => {
        const sanitizedCep = cep.replace(/\D/g, "");

        return sanitizedCep.length === 8
            ? sanitizedCep.replace(/^(\d{5})(\d{3})$/, "$1-$2")
            : sanitizedCep.length === 7
            ? sanitizedCep.replace(/^(\d{4})(\d{3})$/, "$1-$2")
            : cep;
    };

    return {
        phoneFormat,
        cepFormat,
    };
};
