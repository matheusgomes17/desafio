import { useRouter } from 'next/router'
import { useState } from "react";
import CarService from '../../services/cars';

import styles from '../../../styles/Cars.module.css'
import Head from '../Head'
import Header from '../Header'

export default function FormUpdate(props) {
    const router = useRouter()

    const [data, setData] = useState({
        name: props.dataCar ? props.dataCar.name : '',
    })

    const handleChange = (e) => {
        setData(prevState => (
            {
                ...prevState, [e.target.name]: e.target.value
            }
        ))
    }

    const updateData = async (e) => {
        const response = await CarService.update(props.dataCar.id, data);

        router.push('/cars')
    }

    return (
        <div className={styles.container}>
            <Head title="Atualizar Carro - Projeto NextJS"></Head>

            <div className={styles.grid}>
                <a href="/cars" className={styles.back}>
                    <h2>&larr; Voltar</h2>
                </a>
            </div>

            <main className={styles.main}>
                <Header title="Atualizar Carro"></Header>

                <div className={styles.grid}>
                    <form className={styles.form}>
                        <div className={styles.formGroup}>
                            <label>Nome</label>
                            <input type="text"
                                name="name"
                                id="name"
                                value={data.name}
                                onChange={handleChange}
                                className={styles.formControl}
                                required />
                        </div>

                        <a className={styles.btnInfo} onClick={updateData}>Atualizar</a>
                    </form>
                </div>
            </main>
        </div>
    )
}