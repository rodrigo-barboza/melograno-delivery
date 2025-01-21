export default () => {
    const currencyOptions = {
        style: 'currency',
        currency: 'BRL',
    };

    const toCurrency = (value) => new Intl.NumberFormat('pt-BR', currencyOptions).format(value);

    return {
        toCurrency,
    };
};
