import { useRouter } from 'next/router'
import { useState } from "react";
import UserService from '../../services/users';

import styles from '../../../styles/Users.module.css'
import Head from '../Head'
import Header from '../Header'

export default function FormUpdate(props) {
    const router = useRouter()

    const [data, setData] = useState({
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

    const updateData = async (e) => {
        const response = await UserService.update(props.dataUser.id, data);

        router.push('/users')
    }

    return (
        <div className={styles.container}>
            <Head title="Atualizar Usuário - Projeto NextJS"></Head>

            <div className={styles.grid}>
                <a href="/users" className={styles.back}>
                    <h2>&larr; Voltar</h2>
                </a>
            </div>

            <main className={styles.main}>
                <Header title="Atualizar Usuário"></Header>

                <div className={styles.grid}>
                    <form className={styles.form}>
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

                        <a className={styles.btnInfo} onClick={updateData}>Atualizar</a>
                    </form>
                </div>
            </main>
        </div>
    )
}