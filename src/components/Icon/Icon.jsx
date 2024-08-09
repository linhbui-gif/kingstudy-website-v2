'use client';
import React from 'react';

import { EIconName } from './Icon.enum';
import Account from '@/components/Icon/Account';
import AmericanFlag from '@/components/Icon/AmericanFlag';
import ArrowDown from '@/components/Icon/ArrowDown';
import ArrowRight from '@/components/Icon/ArrowRight';
import ArrowTriangleLeft from '@/components/Icon/ArrowTriangleLeft';
import ArrowTriangleRight from '@/components/Icon/ArrowTriangleRight';
import ArtDesign from '@/components/Icon/ArtDesign';
import Australlia_Flag from '@/components/Icon/AustralliaFlag';
import Business from '@/components/Icon/Business';
import Camera from '@/components/Icon/Camera';
import Check from '@/components/Icon/Check';
import Class from '@/components/Icon/Class';
import Compare from '@/components/Icon/Compare';
import ComputerScience from '@/components/Icon/ComputerScience';
import Education from '@/components/Icon/Education';
import Engineering from '@/components/Icon/Engineering';
import Exit from '@/components/Icon/Exit';
import Facebook from '@/components/Icon/Facebook';
import Favorite from '@/components/Icon/Favorite';
import Filter from '@/components/Icon/Filter';
import FollowHs from '@/components/Icon/FollowHs';
import Home from '@/components/Icon/Home';
import Idea from '@/components/Icon/Idea';
import Information from '@/components/Icon/Information';
import Instagram from '@/components/Icon/Instagram';
import Ireland_Flag from '@/components/Icon/IrelandFlag';
import Law from '@/components/Icon/Law';
import Likedine from '@/components/Icon/Likedine';
import Loud from '@/components/Icon/Loud';
import ManageHS from '@/components/Icon/ManageHS';
import Minus from '@/components/Icon/Minus';
import Music from '@/components/Icon/Music';
import Partner from '@/components/Icon/Partner';
import Pdf from '@/components/Icon/Pdf';
import Pharmacy from '@/components/Icon/Pharmacy';
import Plane from '@/components/Icon/Plane';
import Plus from '@/components/Icon/Plus';
import Scholarship from '@/components/Icon/ScholarshipResult';
import ScholarshipResult from '@/components/Icon/ScholarshipResult';
import Search from '@/components/Icon/Search';
import Setting from '@/components/Icon/Setting';
import SocialWork from '@/components/Icon/SocialWork';
import Star from '@/components/Icon/Star';
import StarBorder from '@/components/Icon/StarBorder';
import StudyAboard from '@/components/Icon/StudyAboard';
import Subscribe from '@/components/Icon/Subscribe';
import Twitter from '@/components/Icon/Twitter';
import UK_Flag from '@/components/Icon/UKFlag';
import Vietnam_Flag from '@/components/Icon/VietnamFlag';
import Visa from '@/components/Icon/Visa';
import Word from '@/components/Icon/Word';

const Icon = ({
  name,
  color,
  className = '',
  onClick,
  width,
  height,
  isFavorite,
}) => {
  const renderIcon = () => {
    switch (name) {
      case EIconName.Account:
        return <Account color={color} />;
      case EIconName.ArtDesign:
        return <ArtDesign color={color} />;
      case EIconName.Arrow_Right:
        return <ArrowRight color={color} />;
      case EIconName.American_Flag:
        return <AmericanFlag />;
      case EIconName.Business:
        return <Business color={color} />;
      case EIconName.Class:
        return <Class color={color} />;
      case EIconName.Compare:
        return <Compare width={width} height={height} color={color} />;
      case EIconName.ComputerScience:
        return <ComputerScience color={color} />;
      case EIconName.Education:
        return <Education color={color} />;
      case EIconName.Engineering:
        return <Engineering color={color} />;
      case EIconName.Exit:
        return <Exit color={color} />;
      case EIconName.Facebook:
        return <Facebook color={color} />;
      case EIconName.Favorite:
        return (
          <Favorite
            isFavorite={isFavorite}
            width={width}
            height={height}
            color={color}
          />
        );
      case EIconName.Twitter:
        return <Twitter color={color} />;
      case EIconName.Instagram:
        return <Instagram color={color} />;
      case EIconName.Likedine:
        return <Likedine color={color} />;
      case EIconName.Home:
        return <Home color={color} />;
      case EIconName.Idea:
        return <Idea color={color} />;
      case EIconName.UK_Flag:
        return <UK_Flag />;
      case EIconName.Australlia_Flag:
        return <Australlia_Flag />;
      case EIconName.Ireland_Flag:
        return <Ireland_Flag />;
      case EIconName.Vietnam_Flag:
        return <Vietnam_Flag />;
      case EIconName.Visa:
        return <Visa />;
      case EIconName.Partner:
        return <Partner color={color} />;
      case EIconName.Pharmacy:
        return <Pharmacy color={color} />;
      case EIconName.Scholarship:
        return <Scholarship color={color} />;
      case EIconName.Law:
        return <Law color={color} />;
      case EIconName.Loud:
        return <Loud color={color} />;
      case EIconName.Music:
        return <Music color={color} />;
      case EIconName.ScholarshipResult:
        return <ScholarshipResult color={color} />;
      case EIconName.SocialWork:
        return <SocialWork color={color} />;
      case EIconName.StudyAboard:
        return <StudyAboard color={color} width={width} height={height} />;
      case EIconName.Star:
        return <Star color={color} />;
      case EIconName.StarBorder:
        return <StarBorder color={color} />;
      case EIconName.Search:
        return <Search color={color} />;
      case EIconName.Subscribe:
        return <Subscribe color={color} />;
      case EIconName.Filter:
        return <Filter color={color} />;
      case EIconName.Plane:
        return <Plane color={color} />;
      case EIconName.ArowDown:
        return <ArrowDown width={width} height={height} color={color} />;
      case EIconName.ArrowTriangleLeft:
        return <ArrowTriangleLeft color={color} />;
      case EIconName.ArrowTriangleRight:
        return <ArrowTriangleRight color={color} />;
      case EIconName.Plus:
        return <Plus color={color} />;
      case EIconName.Minus:
        return <Minus color={color} />;
      case EIconName.Check:
        return <Check color={color} />;
      case EIconName.Camera:
        return <Camera color={color} />;
      case EIconName.Words:
        return <Word color={color} />;
      case EIconName.Pdf:
        return <Pdf color={color} />;
      case EIconName.Follow_HS:
        return <FollowHs color={color} />;
      case EIconName.Manage_HS:
        return <ManageHS color={color} />;
      case EIconName.Setting:
        return <Setting color={color} />;
      case EIconName.Information:
        return <Information color={color} />;
      default:
        break;
    }
  };
  return (
    <span
      className={`flex justify-center items-center ${className}`}
      onClick={onClick}
    >
      {renderIcon()}
    </span>
  );
};
export default Icon;
