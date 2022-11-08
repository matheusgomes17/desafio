import { useRouter } from 'next/router'
import { useState } from "react";
import UserService from '../../services/users';

import styles from '../../../styles/Users.module.css'
import Head from '../Head'
import Header from '../Header'

export default function FormCreate(props) {
    const router = useRouter()

    const [data, setData] = useState({
        name: props.dataUser ? props.dataUser.name : '',
        email: props.dataUser ? props.dataUser.email : '',
        password: props.dataUser ? props.dataUser.password : ''
    })

    const handleChange = (e) => {
        setData(prevState => (
            {
                ...prevState, [e.target.name]: e.target.value
            }
        ))
    }

    const storeData = async (e) => {
        const response = await UserService.create(data);
        const user = response.data

        router.push('/users')
    }

    return (
        <div className={styles.container}>
            <Head title="Criar Usuário - Projeto NextJS"></Head>

            <div className={styles.grid}>
                <a href="/users" className={styles.back}>
                    <h2>&larr; Voltar</h2>
                </a>
            </div>

            <main className={styles.main}>
                <Header title="Criar Usuário"></Header>

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
                        
                        <div className={styles.formGroup}>
                            <label>E-mail</label>
                            <input type="email"
                                name="email"
                                id="email"
                                value={data.email}
                                onChange={handleChange}
                                className={styles.formControl}
                                required />
                        </div>

                        <div className={styles.formGroup}>
                            <label>Senha</label>
                            <input type="password"
                                name="password"
                                id="password"
                                value={data.password}
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