const Svg = ({ color = '' }) => {
    return (
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width={20}
            height={20}
            viewBox="0 0 20 20"
            fill="none"
        >
            <path
                fillRule="evenodd"
                clipRule="evenodd"
                d="M8.38744 18V10.9328H6.02637V7.988H8.38744V5.632C8.38744 3.1976 9.93157 2 12.1074 2C13.1497 2 14.046 2.0776 14.3074 2.112V4.656H12.7977C11.6144 4.656 11.3386 5.2184 11.3386 6.0416V7.988H14.2889L13.6989 10.932H11.3386L11.3859 18"
                fill="url(#paint0_linear_126_4957)"
            />
            <defs>
                <linearGradient
                    id="paint0_linear_126_4957"
                    x1="1.02848"
                    y1="-58.1782"
                    x2="34.0086"
                    y2="-53.4582"
                    gradientUnits="userSpaceOnUse"
                >
                    <stop stopColor="#10BDE3" />
                    <stop offset="0.9813" stopColor="#573CFF" />
                </linearGradient>
            </defs>
        </svg>



    )
}
export default Svg