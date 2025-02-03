export default class Order {
    constructor(order) {
        this.id = order?.id;
        this.userId = order?.user_id;
        this.establishmentId = order?.establishment_id;
        this.paymentType = order?.payment_type;
        this.paymentStatus = order?.payment_status;
        this.deliveryType = order?.delivery_type;
        this.status = order?.status;
        this.number = order?.number;
        this.address = order?.address;
        this.cancelationReason = order?.cancelation_reason;
        this.total = order?.total;
        this.deliveryTax = order?.delivery_tax;
        this.totalItems = order?.total_items;
        this.rate = order?.rate;
        this.items = order?.items;
        this.establishment = order?.establishment;
    }
}
