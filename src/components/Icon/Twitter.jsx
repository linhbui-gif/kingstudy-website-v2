const Svg = ({ color = '' }) => {
    return (
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width={48}
            height={47}
            viewBox="0 0 48 47"
            fill="none"
        >
            <ellipse
                cx="23.9484"
                cy="23.1398"
                rx="23.1897"
                ry="23.1398"
                fill="url(#paint0_linear_126_5347)"
            />
            <path
                d="M36.1079 15.5884L33.4991 16.0223L35.2383 13.8529L32.1947 14.7206C28.2814 10.3819 22.1941 15.1545 23.9334 19.0594C16.9765 19.0594 13.498 13.8529 13.498 13.8529C13.498 13.8529 10.8892 17.7577 15.2372 20.7948L12.6284 19.9271C12.6284 22.5303 14.3676 24.2658 17.4113 25.1335H14.3676C16.1068 28.6045 19.1505 28.6045 19.1505 28.6045C19.1505 28.6045 16.5417 30.7739 11.7588 30.7739C26.1074 37.7158 34.8035 24.6997 33.4991 17.7577L36.1079 15.5884Z"
                fill="white"
            />
            <defs>
                <linearGradient
                    id="paint0_linear_126_5347"
                    x1="0.758753"
                    y1="-32.3952"
                    x2="70.4415"
                    y2="-27.6301"
                    gradientUnits="userSpaceOnUse"
                >
                    <stop stopColor="#F58926" />
                    <stop offset="0.921875" stopColor="#E2C523" />
                    <stop offset={1} stopColor="#93871E" />
                </linearGradient>
            </defs>
        </svg>
    )
}
export default Svg