import axios from 'axios';
import { apiUrl } from '../api';

export const userService = {
    paginate
};

const baseUrl = `${apiUrl}/users`;

async function paginate(page) {    
    const response = await axios.get(`${baseUrl}?page=${page}`);

    return response;
}
