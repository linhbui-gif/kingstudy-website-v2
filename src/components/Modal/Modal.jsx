import React from 'react';

import { Modal as AntdModal } from 'antd';

import Button from '@/components/Button';

const Modal = ({
  visible,
  title,
  centered,
  width,
  className = '',
  children,
  loading,
  showActions,
  cancelButton,
  confirmButton,
  zIndex,
  maskStyle,
  onClose,
  onSubmit,
  titleActionOk,
  titleActionCancel,
}) => {
  return (
    <AntdModal
      className={`${className}`}
      style={{ width: 0 }}
      footer={null}
      title={null}
      visible={visible}
      width={width}
      centered={centered}
      zIndex={zIndex}
      onCancel={loading ? undefined : onClose}
      maskStyle={maskStyle}
    >
      <div className="Modal-wrapper">
        <div className="Modal-body">
          {title && (
            <div className="Modal-header">
              <div className="Modal-header-title font-[600] text-[17px] text-[#1C2433]">
                {title}
              </div>
            </div>
          )}

          {children}

          {showActions && (
            <div className="Modal-actions flex justify-center">
              <Button
                title={titleActionOk || 'Đồng ý'}
                disabled={loading}
                onClick={onSubmit}
                {...confirmButton}
              />
              <Button
                title={titleActionCancel || 'Huỷ bỏ'}
                disabled={loading}
                onClick={onClose}
                {...cancelButton}
              />
            </div>
          )}
        </div>
      </div>
    </AntdModal>
  );
};

export default Modal;
