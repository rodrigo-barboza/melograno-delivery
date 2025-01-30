import axios from 'axios';
import useAuth from '@/Composables/useAuth';
import useFormatters from '@/Composables/useFormatters';

export default () => {
    const { address } = useAuth();
    const { sanitizedCep } = useFormatters();

    const getEstablishments = (cartItems) => {
        return Array.from(
            new Map(cartItems.map(({ dish: { establishment } }) => [establishment.id, establishment])).values()
        );
    };

    const getEstablishmentDishes = (establishmentId, cartItems) => cartItems
        .filter(({ dish: { establishment_id } }) => establishment_id === establishmentId);

    const makeOrders = async (form, cartItems) => {
        return await Promise.all(
            getEstablishments(cartItems).map(async (establishment) => {
                const dishes = getEstablishmentDishes(establishment.id, cartItems)
                    .map(({ dish, quantity, comment }) => ({ dish, quantity, comment }));

                return {
                    ...form,
                    items: dishes,
                    establishment_id: establishment.id,
                    delivery_type: form.delivery_type.value,
                    payment_type: form.payment_type.value,
                    delivery_tax: form.delivery_type.value === 'delivery'
                        ? await calculateDeliveryTax(establishment)
                        : null,
                    address: form.delivery_type.value === 'pickup'
                        ? `${establishment.address}, ${establishment.number}`
                        : address(),
                };
            })
        );
    };

    const calculateDeliveryTax = async (establishment) => {
        const params = new URLSearchParams({ origin: sanitizedCep(establishment.cep), destination: sanitizedCep(address(true).cep) });
        const { data: { shippingCost } } = await axios.get(`/checkout/shipping-cost?${params.toString()}`);
        return shippingCost;
    };

    return {
        makeOrders,
        getEstablishments,
    };
};
