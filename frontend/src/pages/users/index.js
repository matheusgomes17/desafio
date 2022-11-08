import React, { useState, useEffect } from 'react';
import ReactPaginate from 'react-paginate';
import Router, { withRouter } from 'next/router'
import { paginate } from '../../services/users'

import Head from 'next/head'
import styles from '../../../styles/Users.module.css'

const Users = (props) => {
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
        content = <tbody><tr><td colspan="3">Carregando...</td></tr></tbody>;
    else {
        content = (
            <tbody>
                {props.users.map(user => {
                    return (
                        <>
                            <tr>
                                <td key={user.id}>{user.name}</td>
                                <td>{user.email}</td>
                                <td></td>
                            </tr>
                        </>
                    )
                })}
            </tbody>
        );
    }

    return (
        <div className={styles.container}>
            <Head>
                <title>Usuários - Projeto NextJS</title>
                <meta name="description" content="Essa é uma aplicação criada para o desafio da vaga de emprego na empresa XXXX" />
                <link rel="icon" href="/favicon.ico" />
            </Head>

            <header className={styles.grid}>
                <a href="/" className={styles.back}>
                    <h2>&larr; Voltar</h2>
                </a>
            </header>

            <main className={styles.main}>
                <h1 className={styles.title}>
                    Lista de Usuários
                </h1>

                <div className={styles.grid}>
                    <table className={styles.table}>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        {content}
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
    const response = paginate(page);
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