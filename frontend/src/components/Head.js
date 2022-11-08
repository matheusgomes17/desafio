import HeadNext from 'next/head'

export default function Head(props) {
    return (
        <HeadNext>
            <title>{props.title}</title>
            <meta name="description" content="Essa é uma aplicação criada para o desafio da vaga de emprego na empresa XXXX" />
            <link rel="icon" href="/favicon.ico" />
        </HeadNext>
    )
}