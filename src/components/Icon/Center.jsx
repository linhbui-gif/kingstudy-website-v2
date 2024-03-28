const Svg = ({ color = '' }) => {
    return (
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width={4}
            height={144}
            viewBox="0 0 4 144"
            fill="none"
        >
            <path
                d="M2 0.259766V143.76"
                stroke="url(#paint0_linear_126_5015)"
                strokeWidth={4}
            />
            <defs>
                <linearGradient
                    id="paint0_linear_126_5015"
                    x1={2}
                    y1="-100.189"
                    x2="3.50948"
                    y2="-100.188"
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