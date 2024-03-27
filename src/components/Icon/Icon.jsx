import React from 'react';
import { EIconName } from './Icon.enum';

const Icon = ({ name, className, color, style, onClick }) => {

    const renderIcon = () => {
        switch (name) {
            case EIconName.Wallet:
                return ""
            default:
                break;
        }
    }
    return (
        <div className='flex justify-center items-center'>
          {renderIcon()}
        </div>
    )
}
export default Icon;