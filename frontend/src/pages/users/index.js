import React, { useState, useEffect } from 'react';
import ReactPaginate from 'react-paginate';
import Router, { useRouter, withRouter } from 'next/router'
import UserService from '../../services/users'

import styles from '../../../styles/Users.module.css'
import Head from '../../components/Head'
import Header from '../../components/Header'
import Swal from 'sweetalert2'

const Users = (props) => {
    const router = useRouter()

    const [isLoading, setLoading] = useState(false)
    const startLoading = () => setLoading(true)
    const stopLoading = () => setLoading(false)

    useEffect(() => {
        Router.events.on('routeChangeStart', startLoading);
        Router.events.on('routeChangeComplete', stopLoading);

        return () => {
            Router.events.off('routeChangeStart', startLoading);
            Router.events.off('routeChangeComplete', stopLoading);
        }
    }, [])

    function deleteUser(id) {
        Swal.fire({
            title: "Remover?",
            text: "Deseja realmente remover esse usuário?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, remova!",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then(async (result) => {
            if (result.isConfirmed) {
                const userDeleted = await UserService.delete(id)

                if (userDeleted.status !== 204) {
                    Swal.fire(
                        'Erro!',
                        result.message,
                        "error"
                    )
                } else {
                    Swal.fire(
                        'Excluído!',
                        'Usuário removido com sucesso',
                        "success"
                    ).then(() => {
                        router.push('/users')
                    })
                }
            }
        })
    }

    const pagginationHandler = (page) => {
        const currentPath = props.router.pathname;
        const currentQuery = props.router.query;
        currentQuery.page = page.selected + 1;

        props.router.push({
            pathname: currentPath,
            query: currentQuery,
        });
    };

    let content = null;

    if (isLoading)
        content = <tr><td colSpan="3">Carregando...</td></tr>;
    else {
        content = (
            <>
                {props.users.map(user => {
                    return (
                        <tr key={user.id}>
                            <td>{user.name}</td>
                            <td>{user.email}</td>
                            <td>
                                <a href={`/users/edit/${encodeURIComponent(user.id)}`} className={styles.btnEdit}>Editar</a>
                                <button onClick={(e) => deleteUser(user.id)} className={styles.btnDelete}>Excluir</button>
                            </td>
                        </tr>
                    )
                })}
            </>
        );
    }

    return (
        <div className={styles.container}>
            <Head title="Usuários - Projeto NextJS"></Head>

            <div className={styles.grid}>
                <a href="/" className={styles.back}>
                    <h2>&larr; Voltar</h2>
                </a>
            </div>

            <main className={styles.main}>
                <Header title="Lista de Usuários"></Header>

                <a href='users/create' className={styles.btnSuccess}>Criar Usuário</a>

                <div className={styles.grid}>
                    <table className={styles.table}>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            {content}
                        </tbody>
                    </table>

                    <ReactPaginate
                        previousLabel={'Anterior'}
                        nextLabel={'Próximo'}
                        breakLabel={'...'}
                        activeClassName={styles.active}
                        containerClassName={styles.pagination}
                        subContainerClassName={'pages pagination'}

                        initialPage={props.currentPage - 1}
                        pageCount={props.pageCount}
                        marginPagesDisplayed={2}
                        pageRangeDisplayed={5}
                        onPageChange={pagginationHandler}
                    />
                </div>
            </main>
        </div>
    );
};

Users.getInitialProps = async ({ query }) => {
    const page = query.page || 1;
    const response = await UserService.paginate(page);
    const users = response.data

    return {
        totalCount: users.meta.total,
        pageCount: users.meta.from,
        currentPage: users.meta.current_page,
        perPage: users.meta.per_page,
        users: users.data,
    };
}

export default withRouter(Users);