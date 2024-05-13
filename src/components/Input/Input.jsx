'use client';

import React, { useEffect, useRef, useState } from 'react';

import { Input as AntdInput } from 'antd';

import { ETimeoutDebounce } from '@/common/enums';
import { formatNumberWithCommas } from '@/utils/function';
import { useDebounce } from '@/utils/hook';

const Input = ({
  type,
  size,
  placeholder,
  prefix,
  suffix,
  value,
  focusOnMount,
  style = '',
  readOnlyText,
  maxLength = 64,
  numberWithSeperator,
  numberstring,
  numberic,
  useNumber,
  disabled,
  onSearch,
  onBlur,
  onChange,
  onEnter,
  allowClear,
  className = '',
}) => {
  const [keyword, setKeyword] = useState('');
  const [isMounted, setIsMounted] = useState(false);
  const searchValueDebounce = useDebounce(keyword, ETimeoutDebounce.SEARCH);

  const inputRef = useRef(null);
  const handleKeydown = (e) => {
    if (e.key === 'Enter' || e.keyCode === 13) {
      onEnter?.(value || keyword);
    }
  };

  const handleChange = (e) => {
    const { value: changedValue } = e.target;
    if (onSearch || onEnter) setKeyword(changedValue);

    if (numberic) {
      const reg = numberstring ? /^\d*?\d*$/ : /^\d*\.?\d*$/;
      const isNumbericPass = reg.test(changedValue) || changedValue === '';

      if (useNumber) {
        if (changedValue === '') {
          onChange?.('');
        } else if (numberWithSeperator) {
          onChange?.(Number(changedValue?.replaceAll(/[.,\s]/g, '')));
        } else {
          onChange?.(
            isNumbericPass ? Number(changedValue) : Number(value) || ''
          );
        }
      } else {
        onChange?.(
          isNumbericPass
            ? String(changedValue || '')
            : String(value || '') || ''
        );
      }
    } else {
      onChange?.(changedValue);
    }
  };

  const commonProps = {
    ref: inputRef,
    size,
    placeholder,
    value:
      numberic && numberWithSeperator && useNumber && typeof value === 'number'
        ? formatNumberWithCommas(Number(value || 0))
        : value,
    prefix,
    suffix,
    maxLength,
    disabled,
    readOnly: readOnlyText,
    onChange: handleChange,
    onKeyDown: handleKeydown,
    onBlur,
    allowClear,
  };

  useEffect(() => {
    if (focusOnMount) inputRef?.current?.focus();
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  useEffect(() => {
    setIsMounted(true);
  }, []);

  useEffect(() => {
    if (isMounted) onSearch?.(searchValueDebounce || undefined);
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [searchValueDebounce]);

  return (
    <div className={`Input relative ${style}`}>
      {type === 'password' ? (
        <AntdInput.Password {...commonProps} />
      ) : (
        <AntdInput rootClassName={className} {...commonProps} />
      )}
    </div>
  );
};

export default Input;
