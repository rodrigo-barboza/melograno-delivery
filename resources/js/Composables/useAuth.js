import { usePage } from "@inertiajs/vue3";

export default () => {
    const page = usePage();

    const address = (object = false) => object ? page.props.auth?.user?.address : page.props.auth?.user?.address?.address;
    const establishment = page.props?.auth?.user?.establishment;
    const hasAddress = () => !!page.props.auth?.user?.address;
    const hasEstablishment = () => !!page.props.auth?.user?.establishment;
    const isLoggedIn = () => !!page.props.auth?.user;
    const user = page.props?.auth?.user;
    const updateAddress = (address) => page.props.auth.user.address = address;

    return {
        address,
        establishment,
        hasAddress,
        hasEstablishment,
        isLoggedIn,
        user,
        updateAddress,
    };
};
