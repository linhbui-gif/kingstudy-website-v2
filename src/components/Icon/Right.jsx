const Svg = ({ color = '' }) => {
    return (
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width={369}
            height={124}
            viewBox="0 0 369 124"
            fill="none"
        >
            <path
                d="M2 0.759766V47.7598C2 58.8055 10.9543 67.7598 22 67.7598H347C358.046 67.7598 367 76.7141 367 87.7598V123.26"
                stroke="url(#paint0_linear_126_5022)"
                strokeWidth={4}
            />
            <defs>
                <linearGradient
                    id="paint0_linear_126_5022"
                    x1={367}
                    y1="-84.9889"
                    x2="-162.089"
                    y2="22.5816"
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