export const WAINTING = 'waiting';
export const IN_PREPARATION = 'in_preparation';
export const AVAILABLE_FOR_PICKUP = 'available_for_pickup';
export const DELIVERING = 'delivering';
export const COMPLETED = 'completed';
export const CANCELED = 'canceled';

export const STATUS = {
    [WAINTING]: { level: 1, label: 'Pedido realizado', textColor: '#1E1E1E', icon: 'clock', iconColor: '#3880EC' },
    [IN_PREPARATION]: { level: 2, label: 'Pedido em preparação', textColor: '#1E1E1E', icon: 'clock', iconColor: '#3880EC' },
    [AVAILABLE_FOR_PICKUP]: { level: 3, label: 'Disponível para retirada', textColor: '#1E1E1E', icon: 'clock', iconColor: '#3880EC' },
    [DELIVERING]: { level: 3, label: 'Saiu para entrega', textColor: '#1E1E1E', icon: 'clock', iconColor: '#3880EC' },
    [COMPLETED]: { level: 4, label: 'Pedido finalizado', textColor: '#1E1E1E', icon: 'check', iconColor: '#50A773' },
    [CANCELED]: { level: 4, label: 'Pedido cancelado', textColor: '#F34444', icon: 'x', iconColor: '#F34444' },
};

