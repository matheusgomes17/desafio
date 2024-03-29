import axios from 'axios';
import { apiUrl } from '../../../config';

const baseUrl = `${apiUrl}/users`;

async function findById(id) {
    const response = await axios.get(`${baseUrl}/${id}`);

    return response.data;
}

async function paginate(page) {
    const response = await axios.get(`${baseUrl}?page=${page}`);

    return response;
}

async function create(params) {
    const response = await axios.post(`${baseUrl}`, params);

    return response;
}

async function update(id, params) {
    const response = await axios.put(`${baseUrl}/${id}`, params);

    return response;
}

async function destroy(id) {
    const response = await axios.delete(`${baseUrl}/${id}`);

    return response;
}

async function attachCar(id, params) {
    const response = await axios.post(`${baseUrl}/${id}/cars/attach`, {cars: params});

    return response;
}

async function detachCar(id, params) {
    const response = await axios.post(`${baseUrl}/${id}/cars/detach`, {cars: params});

    return response;
}

export default {
    findById,
    paginate,
    create,
    update,
    delete: destroy,
    attachCar,
    detachCar
};