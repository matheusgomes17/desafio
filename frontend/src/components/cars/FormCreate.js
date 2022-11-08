import { useRouter } from 'next/router'
import { useState } from "react";
import CarService from '../../services/cars';

import styles from '../../../styles/Cars.module.css'
import Head from '../Head'
import Header from '../Header'

export default function FormCreate(props) {
    const router = useRouter()

    const [data, setData] = useState({
        name: props.dataUser ? props.dataUser.name : '',
    })

    const handleChange = (e) => {
        setData(prevState => (
            {
                ...prevState, [e.target.name]: e.target.value
            }
        ))
    }

    const storeData = async (e) => {
        const response = await CarService.create(data);

        router.push('/cars')
    }

    return (
        <div className={styles.container}>
            <Head title="Criar Carro - Projeto NextJS"></Head>

            <div className={styles.grid}>
                <a href="/cars" className={styles.back}>
                    <h2>&larr; Voltar</h2>
                </a>
            </div>

            <main className={styles.main}>
                <Header title="Criar Carro"></Header>

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
                        
                        <a className={styles.btnSuccess} onClick={storeData}>Cadastrar</a>
                    </form>
                </div>
            </main>
        </div>
    )
}