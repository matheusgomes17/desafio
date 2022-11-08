import styles from '../../styles/Users.module.css'

export default function Header(props) {
    return (
        <h1 className={styles.title}>
            {props.title}
        </h1>
    )
}